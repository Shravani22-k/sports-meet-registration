<?php
require 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$reg = null;

if ($id > 0) {
    $stmt = $conn->prepare('SELECT * FROM registrations WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $reg = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
$conn->close();

function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES); }

$sportIcon = '🏅';
$sportName = '—';
if ($reg && !empty($reg['sport'])) {
    $parts = explode(' ', $reg['sport'], 2);
    $sportIcon = $parts[0] ?? '🏅';
    $sportName = $parts[1] ?? $reg['sport'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $reg ? 'Confirmed: ' . h($reg['full_name']) . ' — Sports Meet 2026' : 'Registration Confirmed — Annual Sports Meet 2026' ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Space+Mono:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg-night:#0B1120;
    --bg-panel:#131B2E;
    --bg-panel-2:#1B2540;
    --track-orange:#FF6B35;
    --medal-gold:#FFC93C;
    --finish-green:#2EE6A6;
    --text-light:#F5F6FA;
    --text-muted:#8E97AE;
    --line:rgba(255,255,255,0.10);
    --font-display:'Anton', sans-serif;
    --font-body:'Inter', sans-serif;
    --font-mono:'Space Mono', monospace;
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{
    background:var(--bg-night);
    color:var(--text-light);
    font-family:var(--font-body);
    min-height:100vh;
    display:flex; flex-direction:column;
  }
  h1,h2{font-family:var(--font-display); font-weight:400; margin:0;}
  :focus-visible{outline:2px solid var(--medal-gold); outline-offset:3px;}

  .topbar{
    display:flex; align-items:center; justify-content:space-between;
    padding:22px 6vw; border-bottom:1px solid var(--line);
  }
  .brand{display:flex; align-items:center; gap:10px; font-family:var(--font-display); font-size:1.25rem; letter-spacing:0.04em;}
  .brand .dot{width:10px; height:10px; border-radius:50%; background:var(--finish-green); box-shadow:0 0 0 4px rgba(46,230,166,0.15);}

  main{flex:1; display:flex; align-items:center; justify-content:center; padding:60px 6vw;}

  .confirm-wrap{max-width:760px; width:100%; text-align:center;}
  .status-icon{font-size:2.6rem; margin-bottom:18px;}
  .confirm-wrap h1{font-size:clamp(2rem,5vw,3.2rem); text-transform:uppercase; margin-bottom:12px;}
  .confirm-wrap h1 span{color:var(--finish-green);}
  .confirm-wrap > p{color:var(--text-muted); margin-bottom:44px; font-size:1.05rem;}

  .ticket{
    display:grid; grid-template-columns:1fr 220px;
    background:linear-gradient(155deg, var(--bg-panel-2), var(--bg-panel));
    border:1px solid var(--line); border-radius:18px;
    position:relative; text-align:left; margin-bottom:36px;
    box-shadow:0 30px 60px -20px rgba(0,0,0,0.5);
  }
  .ticket-main{padding:32px 34px;}
  .ticket-stub{
    padding:32px 24px; border-left:1px dashed var(--line);
    display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center;
    position:relative;
  }
  .ticket-stub::before, .ticket-stub::after{
    content:""; position:absolute; width:22px; height:22px; background:var(--bg-night);
    border-radius:50%; left:-11px;
  }
  .ticket-stub::before{top:-11px;}
  .ticket-stub::after{bottom:-11px;}

  .tag{font-family:var(--font-mono); font-size:0.72rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--text-muted);}
  .pname{font-family:var(--font-display); font-size:1.9rem; text-transform:uppercase; margin:8px 0 2px; word-break:break-word;}
  .pinst{color:var(--text-muted); font-size:0.92rem; margin-bottom:22px;}
  .ticket hr{border:none; border-top:1px dashed var(--line); margin:18px 0;}
  .meta-grid{display:grid; grid-template-columns:1fr 1fr; gap:16px;}
  .meta-grid .k{font-size:0.72rem; text-transform:uppercase; letter-spacing:0.06em; color:var(--text-muted);}
  .meta-grid .v{font-weight:600; margin-top:3px; font-size:0.95rem;}

  .stub-label{font-family:var(--font-mono); font-size:0.7rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--text-muted); margin-bottom:8px;}
  .stub-bib{font-family:var(--font-mono); font-size:1.7rem; font-weight:700; color:var(--medal-gold); line-height:1.2;}
  .stub-sport{font-size:1.8rem; margin-top:14px;}

  .actions{display:flex; gap:14px; justify-content:center; flex-wrap:wrap;}
  .btn{
    display:inline-flex; align-items:center; gap:8px; font-weight:600; font-size:0.95rem;
    padding:14px 26px; border-radius:999px; border:none; cursor:pointer; text-decoration:none;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .btn-primary{background:var(--track-orange); color:#180A02;}
  .btn-primary:hover{box-shadow:0 8px 22px rgba(255,107,53,0.35); transform:translateY(-1px);}
  .btn-ghost{background:transparent; color:var(--text-light); border:1px solid var(--line);}
  .btn-ghost:hover{border-color:var(--text-muted);}

  .empty-state{max-width:480px; margin:0 auto; text-align:center;}
  .empty-state .status-icon{color:var(--text-muted);}

  footer{padding:24px 6vw; border-top:1px solid var(--line); color:var(--text-muted); font-size:0.82rem; text-align:center;}

  @media (max-width:640px){
    .ticket{grid-template-columns:1fr;}
    .ticket-stub{border-left:none; border-top:1px dashed var(--line);}
    .ticket-stub::before, .ticket-stub::after{left:50%; top:-11px; transform:translateX(-50%);}
    .ticket-stub::after{bottom:auto; top:auto; top:calc(100% - 11px);}
  }

  @media print{
    .topbar, .actions, footer{display:none;}
    body{background:#fff; color:#111;}
    .ticket{border-color:#ccc;}
  }
</style>
</head>
<body>

  <header class="topbar">
    <div class="brand"><span class="dot"></span> SPORTS MEET 2026</div>
  </header>

  <main>
    <?php if ($reg): ?>
    <div class="confirm-wrap">
      <div class="status-icon">🏁</div>
      <h1>You're <span>registered!</span></h1>
      <p>Save your bib number below — you'll need it at check-in on event day. This pass is loaded live from the database.</p>

      <div class="ticket">
        <div class="ticket-main">
          <div class="tag">Annual Sports Meet 2026 · Participant Pass</div>
          <div class="pname"><?= h($reg['full_name']) ?></div>
          <div class="pinst"><?= h($reg['institution']) ?></div>
          <hr>
          <div class="meta-grid">
            <div><div class="k">Sport</div><div class="v"><?= h($sportName) ?></div></div>
            <div><div class="k">Participation</div><div class="v"><?= h($reg['participation']) ?></div></div>
            <div><div class="k">Team name</div><div class="v"><?= h($reg['team_name'] ?: '—') ?></div></div>
            <div><div class="k">T-shirt size</div><div class="v"><?= h($reg['tshirt']) ?></div></div>
            <div><div class="k">Venue</div><div class="v">City Sports Complex</div></div>
            <div><div class="k">Event dates</div><div class="v">14–16 Aug 2026</div></div>
          </div>
        </div>
        <div class="ticket-stub">
          <div class="stub-label">Bib number</div>
          <div class="stub-bib"><?= h($reg['bib']) ?></div>
          <div class="stub-sport"><?= h($sportIcon) ?></div>
        </div>
      </div>

      <div class="actions">
        <button class="btn btn-primary" onclick="window.print()">🖨️ Print pass</button>
        <a class="btn btn-ghost" href="index.html">Register another participant</a>
      </div>
    </div>
    <?php else: ?>
    <div class="empty-state">
      <div class="status-icon">⚠️</div>
      <h1>No registration found</h1>
      <p style="color:var(--text-muted); margin:14px 0 28px;">We couldn't find that registration in the database. Please complete the registration form first.</p>
      <a class="btn btn-primary" href="index.html">Go to registration form</a>
    </div>
    <?php endif; ?>
  </main>

  <footer>© 2026 Annual Sports Meet Committee · sportsmeet2026@example.com</footer>

</body>
</html>
