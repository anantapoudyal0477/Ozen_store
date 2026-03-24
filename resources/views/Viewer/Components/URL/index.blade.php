<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Find Me Online</title>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #e8f4ff;
      --surface: #ffffff;
      --border: rgba(59,130,246,0.15);
      --text: #0f2a50;
      --muted: #6b8ab0;
      --accent: #2563eb;
    }

    html, body {
      height: 100%;
      background: var(--bg);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background:
        radial-gradient(ellipse 70% 50% at 10% 0%, rgba(96,165,250,0.35) 0%, transparent 55%),
        radial-gradient(ellipse 60% 60% at 90% 100%, rgba(37,99,235,0.2) 0%, transparent 55%),
        radial-gradient(ellipse 50% 40% at 50% 50%, rgba(147,197,253,0.25) 0%, transparent 65%);
      pointer-events: none;
      z-index: 0;
    }

    .blob {
      position: fixed;
      border-radius: 50%;
      filter: blur(60px);
      pointer-events: none;
      z-index: 0;
      opacity: 0.45;
      animation: drift 8s ease-in-out infinite;
    }
    .blob1 { width: 300px; height: 300px; background: #93c5fd; top: -80px; left: -80px; animation-delay: 0s; }
    .blob2 { width: 250px; height: 250px; background: #bfdbfe; bottom: -60px; right: -60px; animation-delay: -3s; }
    .blob3 { width: 180px; height: 180px; background: #ddd6fe; top: 40%; right: 5%; animation-delay: -5s; }

    @keyframes drift {
      0%, 100% { transform: translate(0, 0) scale(1); }
      33%       { transform: translate(20px, -20px) scale(1.05); }
      66%       { transform: translate(-15px, 15px) scale(0.97); }
    }

    .container {
      position: relative;
      z-index: 1;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 60px 20px;
    }

    .avatar-wrap {
      position: relative;
      width: 96px;
      height: 96px;
      margin-bottom: 24px;
      animation: fadeDown 0.7s ease both;
    }

    .avatar {
      width: 96px;
      height: 96px;
      border-radius: 50%;
      background: linear-gradient(135deg, #2563eb, #60a5fa, #38bdf8);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Bebas Neue', sans-serif;
      font-size: 36px;
      letter-spacing: 2px;
      color: #fff;
      position: relative;
      z-index: 1;
      box-shadow: 0 8px 32px rgba(37,99,235,0.35);
    }

    .avatar-ring {
      position: absolute;
      inset: -4px;
      border-radius: 50%;
      background: conic-gradient(from 0deg, #2563eb, #60a5fa, #38bdf8, #818cf8, #2563eb);
      z-index: 0;
      animation: spin 4s linear infinite;
    }

    .avatar-ring::before {
      content: '';
      position: absolute;
      inset: 3px;
      border-radius: 50%;
      background: var(--bg);
    }

    @keyframes spin { to { transform: rotate(360deg); } }

    .name {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(42px, 8vw, 72px);
      letter-spacing: 4px;
      line-height: 1;
      text-align: center;
      animation: fadeDown 0.7s 0.1s ease both;
      background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 40%, #0ea5e9 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .tagline {
      font-size: 13px;
      color: var(--muted);
      letter-spacing: 3px;
      text-transform: uppercase;
      margin-top: 8px;
      margin-bottom: 48px;
      text-align: center;
      animation: fadeDown 0.7s 0.2s ease both;
    }

    .links {
      width: 100%;
      max-width: 430px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .card {
      display: flex;
      align-items: center;
      gap: 18px;
      padding: 18px 22px;
      border-radius: 20px;
      background: var(--surface);
      border: 1.5px solid var(--border);
      text-decoration: none;
      color: var(--text);
      position: relative;
      overflow: hidden;
      transition: transform 0.25s cubic-bezier(.34,1.56,.64,1), box-shadow 0.25s ease, border-color 0.25s ease;
      cursor: pointer;
      box-shadow: 0 2px 12px rgba(37,99,235,0.07);
    }

    .card:nth-child(1) { animation: fadeUp 0.6s 0.3s ease both; }
    .card:nth-child(2) { animation: fadeUp 0.6s 0.42s ease both; }
    .card:nth-child(3) { animation: fadeUp 0.6s 0.54s ease both; }
    .card:nth-child(4) { animation: fadeUp 0.6s 0.66s ease both; }

    .card::before {
      content: '';
      position: absolute;
      inset: 0;
      opacity: 0;
      transition: opacity 0.3s ease;
      border-radius: inherit;
    }

    .card.facebook::before  { background: linear-gradient(90deg, rgba(24,119,242,0.07) 0%, transparent 70%); }
    .card.instagram::before { background: linear-gradient(90deg, rgba(221,42,123,0.07) 0%, transparent 70%); }
    .card.tiktok::before    { background: linear-gradient(90deg, rgba(255,0,80,0.07) 0%, transparent 70%); }
    .card.whatsapp::before  { background: linear-gradient(90deg, rgba(37,211,102,0.07) 0%, transparent 70%); }

    .card:hover::before { opacity: 1; }
    .card:hover { transform: translateY(-4px) scale(1.01); }
    .card:active { transform: scale(0.98); }

    .card.facebook:hover  { box-shadow: 0 16px 40px rgba(24,119,242,0.18);  border-color: rgba(24,119,242,0.35); }
    .card.instagram:hover { box-shadow: 0 16px 40px rgba(221,42,123,0.15); border-color: rgba(221,42,123,0.35); }
    .card.tiktok:hover    { box-shadow: 0 16px 40px rgba(255,0,80,0.15);   border-color: rgba(255,0,80,0.35); }
    .card.whatsapp:hover  { box-shadow: 0 16px 40px rgba(37,211,102,0.2);  border-color: rgba(37,211,102,0.35); }

    .icon-wrap {
      width: 52px;
      height: 52px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      position: relative;
      z-index: 1;
    }

    .facebook .icon-wrap  { background: rgba(24,119,242,0.1); }
    .instagram .icon-wrap { background: rgba(221,42,123,0.08); }
    .tiktok .icon-wrap    { background: rgba(255,0,80,0.08); }
    .whatsapp .icon-wrap  { background: rgba(37,211,102,0.1); }

    .icon-wrap svg { width: 26px; height: 26px; }

    .card-info {
      flex: 1;
      position: relative;
      z-index: 1;
    }

    .platform {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 22px;
      letter-spacing: 2px;
      line-height: 1;
    }

    .handle {
      font-size: 13px;
      color: var(--muted);
      margin-top: 3px;
      font-weight: 300;
    }

    .arrow {
      position: relative;
      z-index: 1;
      color: #b8cfe8;
      transition: transform 0.25s ease, color 0.25s ease;
    }

    .card:hover .arrow { transform: translateX(4px); color: var(--text); }

    .divider {
      width: 100%;
      max-width: 430px;
      display: flex;
      align-items: center;
      gap: 14px;
      margin: 36px 0 24px;
      animation: fadeUp 0.6s 0.82s ease both;
    }

    .divider span {
      font-size: 11px;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--muted);
      white-space: nowrap;
    }

    .divider::before, .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: rgba(37,99,235,0.15);
    }

    .extras {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      justify-content: center;
      animation: fadeUp 0.6s 0.94s ease both;
    }

    .pill {
      padding: 8px 18px;
      border-radius: 100px;
      border: 1.5px solid rgba(37,99,235,0.18);
      background: #fff;
      font-size: 12px;
      letter-spacing: 1px;
      color: var(--muted);
      text-decoration: none;
      transition: color 0.2s, border-color 0.2s, background 0.2s, box-shadow 0.2s;
      box-shadow: 0 1px 6px rgba(37,99,235,0.06);
    }

    .pill:hover {
      color: var(--accent);
      border-color: rgba(37,99,235,0.4);
      background: #eff6ff;
      box-shadow: 0 4px 14px rgba(37,99,235,0.12);
    }

    .footer {
      margin-top: 56px;
      font-size: 11px;
      color: #a8c4e0;
      letter-spacing: 2px;
      text-transform: uppercase;
      animation: fadeUp 0.6s 1.05s ease both;
    }

    @keyframes fadeDown {
      from { opacity: 0; transform: translateY(-20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="blob blob1"></div>
  <div class="blob blob2"></div>
  <div class="blob blob3"></div>

<div class="container">

  <div class="avatar-wrap">
    <div class="avatar-ring"></div>
<div class="avatar">
  {{ strtoupper(substr($ownerName, 0, 2)) }}
</div>
  </div>

  <h1 class="name">{{ $ownerName }}</h1>
  <p class="tagline">Follow the journey</p>

  <div class="links">

    <!-- Facebook -->
    <a class="card facebook" href="https://www.facebook.com/profile.php?id=61587742575807" target="_blank" rel="noopener">
      <div class="icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="#1877f2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="card-info">
        <div class="platform" style="color:#1877f2">Facebook</div>
        <div class="handle">Ozen store</div>
      </div>
      <div class="arrow">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </div>
    </a>

    <!-- Instagram -->
    <a class="card instagram" href="https://www.instagram.com/ozen_eye_wear?igsh=MTQ5Zm10aWRjazNrYQ%3D%3D" target="_blank" rel="noopener">
      <div class="icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="url(#ig2)" stroke-width="2"/>
          <circle cx="12" cy="12" r="4" stroke="url(#ig2)" stroke-width="2"/>
          <circle cx="17.5" cy="6.5" r="1" fill="#dd2a7b"/>
          <defs>
            <linearGradient id="ig2" x1="2" y1="2" x2="22" y2="22" gradientUnits="userSpaceOnUse">
              <stop offset="0%" stop-color="#f58529"/>
              <stop offset="50%" stop-color="#dd2a7b"/>
              <stop offset="100%" stop-color="#515bd4"/>
            </linearGradient>
          </defs>
        </svg>
      </div>
      <div class="card-info">
        <div class="platform" style="background:linear-gradient(90deg,#f58529,#dd2a7b,#515bd4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Instagram</div>
        <div class="handle">Ozen store</div>
      </div>
      <div class="arrow">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </div>
    </a>

    <!-- TikTok -->
    <a class="card tiktok" href="https://www.tiktok.com/@ozeneyewear2" target="_blank" rel="noopener">
      <div class="icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" stroke="#ff0050" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="card-info">
        <div class="platform" style="color:#ff0050">TikTok</div>
        <div class="handle">Ozen store</div>
      </div>
      <div class="arrow">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </div>
    </a>

    <!-- WhatsApp -->
    <a class="card whatsapp" href="https://wa.me/9744593083" target="_blank" rel="noopener">
      <div class="icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="#25d366" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="card-info">
        <div class="platform" style="color:#25d366">WhatsApp</div>
        <div class="handle">+977 9744593083</div>
      </div>
      <div class="arrow">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </div>
    </a>

  </div>

  {{-- <div class="divider"><span>Also here</span></div> --}}

  {{-- <div class="extras">
    <a class="pill" href="https://twitter.com" target="_blank" rel="noopener">Twitter / X</a>
    <a class="pill" href="https://youtube.com" target="_blank" rel="noopener">YouTube</a>
    <a class="pill" href="mailto:you@email.com">Email Me</a>
  </div> --}}
<div class="divider"><span>Contact</span></div>

<div class="extras">

  <a class="pill" href="tel:{{ $phone }}">
    📞 {{ $phone }}
  </a>

  <a class="pill" href="mailto:{{ $email }}">
    ✉️ {{ $email }}
  </a>

  <a class="pill" href="#">
    📍 {{ $address }}
  </a>

</div>
<p class="footer">© {{ date('Y') }} · {{ $ownerName }}</p>

</div>
</body>
</html>