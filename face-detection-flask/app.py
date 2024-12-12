from flask import Flask, render_template, Response, jsonify, redirect, url_for
import cv2
import mediapipe as mp
import pygame
import time

# Initialize Flask app
app = Flask(__name__)

# Initialize pygame mixer for sound alerts
pygame.mixer.init()

# Global variables for distraction state and timers
distraction_timer = 0
distraction_threshold = 20  # Seconds before alert
start_time = None
distracted = False
session_start_time = None
total_session_time = 0
total_distraction_time = 0
accumulated_distraction_time = 0  # To store the accumulated distraction time

# Variables to store session results
session_results = {}

def calculate_vertical_tilt(eye_left, eye_right, nose, chin):
    """Calculate vertical tilt to detect 'looking down'."""
    eye_center_y = (eye_left[1] + eye_right[1]) / 2
    nose_to_eye = abs(nose[1] - eye_center_y)
    chin_to_nose = abs(chin[1] - nose[1])
    if chin_to_nose == 0:
        return 0
    tilt_ratio = nose_to_eye / chin_to_nose
    return tilt_ratio

def play_sound():
    """Play alert sound when user is distracted for too long."""
    pygame.mixer.music.load("static/alert.mp3")
    pygame.mixer.music.play()

def analyze_activity():
    """Analyze live video feed to detect 'looking down' based on vertical tilt."""
    global start_time, distracted, distraction_timer, session_start_time, total_session_time, total_distraction_time, accumulated_distraction_time

    mp_face_mesh = mp.solutions.face_mesh
    face_mesh = mp_face_mesh.FaceMesh(min_detection_confidence=0.7, min_tracking_confidence=0.7)
    cap = cv2.VideoCapture(0)

    if not session_start_time:
        session_start_time = time.time()

    while cap.isOpened():
        ret, frame = cap.read()
        if not ret:
            break

        frame = cv2.flip(frame, 1)
        rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        results = face_mesh.process(rgb_frame)

        if results.multi_face_landmarks:
            for landmarks in results.multi_face_landmarks:
                ih, iw, _ = frame.shape
                eye_left = landmarks.landmark[33]
                eye_right = landmarks.landmark[263]
                nose_tip = landmarks.landmark[1]
                chin = landmarks.landmark[152]

                eye_l = (int(eye_left.x * iw), int(eye_left.y * ih))
                eye_r = (int(eye_right.x * iw), int(eye_right.y * ih))
                nose = (int(nose_tip.x * iw), int(nose_tip.y * ih))
                chin = (int(chin.x * iw), int(chin.y * ih))

                tilt_ratio = calculate_vertical_tilt(eye_l, eye_r, nose, chin)

                if 0.5 < tilt_ratio < 1.5:
                    activity = "Focused (Looking Down)"
                    if distracted:
                        elapsed_distraction_time = time.time() - start_time
                        accumulated_distraction_time += elapsed_distraction_time
                    distracted = False
                    start_time = None
                    distraction_timer = 0
                    pygame.mixer.music.stop()
                else:
                    activity = "Distracted (Not Looking Down)"
                    if not distracted:
                        distracted = True
                        start_time = time.time()

                if distracted and start_time:
                    elapsed_time = time.time() - start_time
                    distraction_timer = int(elapsed_time)

                    if distraction_timer >= distraction_threshold and not pygame.mixer.music.get_busy():
                        play_sound()

                total_session_time = int(time.time() - session_start_time)
                cv2.putText(frame, activity, (30, 30), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
                cv2.putText(frame, f"Time Left: {max(distraction_threshold - distraction_timer, 0)}s", (30, 60),
                            cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
                cv2.putText(frame, f"Session Time: {total_session_time}s", (30, 90),
                            cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
                cv2.putText(frame, f"Total Distraction: {int(accumulated_distraction_time)}s", (30, 120),
                            cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)
        else:
            activity = "No Face Detected"
            if distracted:
                elapsed_distraction_time = time.time() - start_time
                accumulated_distraction_time += elapsed_distraction_time
            distracted = False
            pygame.mixer.music.stop()
            start_time = None
            distraction_timer = 0
            cv2.putText(frame, activity, (30, 30), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 0, 255), 2)

        _, buffer = cv2.imencode('.jpg', frame)
        yield (b'--frame\r\nContent-Type: image/jpeg\r\n\r\n' + buffer.tobytes() + b'\r\n')

    cap.release()

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/video_feed")
def video_feed():
    return Response(analyze_activity(), mimetype="multipart/x-mixed-replace; boundary=frame")

@app.route("/distraction_timer")
def get_timer():
    global distraction_timer, total_session_time, accumulated_distraction_time
    return jsonify({
        "distraction_timer": distraction_timer,
        "total_session_time": total_session_time,
        "total_distraction_time": int(accumulated_distraction_time)
    })


@app.route("/stop_session")
def stop_session():
    global distraction_timer, start_time, distracted, session_start_time, total_session_time, total_distraction_time, accumulated_distraction_time, session_results

    # Calculate statistics for the current session
    concentration_time = total_session_time - accumulated_distraction_time
    concentration_level = (concentration_time / total_session_time) * 100 if total_session_time > 0 else 0
    session_results = {
        "total_time": total_session_time,
        "distraction_time": int(accumulated_distraction_time),
        "concentration_time": int(concentration_time),
        "concentration_level": round(concentration_level, 2)
    }

    # Reset all session-related variables
    distraction_timer = 0
    start_time = None
    distracted = False
    session_start_time = None
    total_session_time = 0
    total_distraction_time = 0
    accumulated_distraction_time = 0

    return jsonify({"status": "Session stopped"})


@app.route("/main")
def main():
    return render_template("main.html", **session_results)

if __name__ == "__main__":
    app.run(debug=True)
