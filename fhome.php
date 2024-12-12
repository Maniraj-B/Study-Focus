<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Study Focus</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(180deg, black 67%, #1DB5BE 170%);
      background-repeat: no-repeat;
      background-size: cover;
      min-height: 100vh;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Header Section */
    .header {
      text-align: center;
      margin-top: 50px;
    }

    .header h1 {
      font-size: 48px;
      font-weight: 700;
      color: #1DB5BE;
      margin: 0;
    }

    .header p {
      font-size: 18px;
      font-weight: 400;
      margin-top: 10px;
    }

    /* Features Section */
    .features {
      display: flex;
      justify-content: space-around;
      align-items: flex-start;
      width: 100%;
      margin: 50px 0;
    }

    .feature {
      text-align: center;
      max-width: 300px;
    }

    .feature img {
      width: 80px;
      height: 80px;
      margin-bottom: 20px;
      border-radius: 10px; /* Optional styling for images */
    }

    .feature h2 {
      font-size: 24px;
      font-weight: 700;
      color: #1DB5BE;
    }

    .feature p {
      font-size: 16px;
      font-weight: 400;
    }

    /* Register Button */
    .register-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #1DB5BE;
      color: black;
      font-size: 16px;
      font-weight: 600;
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-transform: uppercase;
    }

    .register-btn:hover {
      background: #17a3ac;
    }

    /* Logo Section */
    .logo {
      position: absolute;
      top: 20px;
      left: 20px;
    }

    .logo img {
      width: 100px;
      height: auto;
    }

    /* Footer Section */
    .footer {
      text-align: center;
      margin-top: 50px;
      font-size: 18px;
      font-weight: 600;
    }
    .logo img{
      height: 290px;
      width: 290px;
      position: fixed;
      margin-top: -90px;
      margin-left: -60px;
      z-index: 1;

    }
  </style>
</head>
<body>
  <!-- Logo Placeholder -->
  <div class="logo">
    <img src="logo.png" alt="Logo Placeholder">
  </div>

  <!-- Register Button -->
  <button class="register-btn" onclick="reg()">Register Now</button>
  <script>
    function reg(){
        window.location.href = "/studyfocus"
    }
    </script>
<br><br><Br><br><br>
  <!-- Header Section -->
  <div class="header">
    <h1>Stay Focused, Stay Productive</h1>
    <p>Lorem ipsum is common placeholder text used to demonstrate the graphic elements of a document or visual presentation.</p>
  </div>

  <!-- Features Section -->
  <div class="features">
    <div class="feature">
      <img src="start_session.png" alt="Start Your Session Placeholder">
      <h2>Start Your Session</h2>
      <p>Webcam activates and monitors your presence.</p>
    </div>
    <div class="feature">
      <img src="Ai_chatboot.png" alt="AI Chatbot Placeholder">
      <h2>AI Chatbot</h2>
      <p>Personalized AI and Global Chat for Doubt Clarifications.</p>
    </div>
    <div class="feature">
      <img src="insights.png" alt="Receive Insights Placeholder">
      <h2>Receive Insights</h2>
      <p>Real-time feedback and personalized tips delivered.</p>
    </div>
  </div>

  <!-- Footer Section -->
  <div class="footer">
    Presented by Team MSAV
  </div>
</body>
</html>
