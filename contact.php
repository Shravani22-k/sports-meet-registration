<?php
require 'config.php';

function field($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : '';
}

$errors = [];
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = field('name');
    $email   = field('email');
    $phone   = field('phone');
    $subject = field('subject');
    $message = field('message');

    if (!$name)    { $errors[] = 'Please enter your name.'; }
    if (!$email)   { $errors[] = 'Please enter your email address.'; }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = 'That email address doesn\'t look valid.'; }
    if (!$phone)   { $errors[] = 'Please enter a phone number.'; }
    if (!$subject) { $errors[] = 'Please choose a subject.'; }
    if (!$message) { $errors[] = 'Please write a short message.'; }

    if (!$errors) {
        $stmt = $conn->prepare(
            'INSERT INTO inquiries (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('sssss', $name, $email, $phone, $subject, $message);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header('Location: contact.php?sent=1');
            exit;
        } else {
            $errors[] = 'Sorry, something went wrong saving your message: ' . htmlspecialchars($stmt->error);
            $stmt->close();
        }
    }
}

$conn->close();

$justSent = isset($_GET['sent']) && $_GET['sent'] === '1';

function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES); }
function old($key) { return isset($_POST[$key]) ? h($_POST[$key]) : ''; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact — Annual Sports Meet 2026</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Space+Mono:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>
  .contact-layout{
    padding:5vw 6vw 8vw;
    display:grid;
    grid-template-columns:1fr 320px;
    gap:48px;
    align-items:start;
  }
  .info-card{background:var(--bg-panel); border:1px solid var(--line); border-radius:var(--radius); padding:28px; margin-bottom:20px;}
  .info-card .k{font-family:var(--font-mono); font-size:0.72rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--text-muted); margin-bottom:6px;}
  .info-card .v{font-weight:600;}
  @media (max-width:900px){ .contact-layout{grid-template-columns:1fr;} }
</style>
</head>
<body>

  <header class="topbar">
    <a href="index.html" class="brand"><span class="dot"></span> SPORTS MEET 2026</a>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="events.html">Events</a>
      <a href="gallery.html">Gallery</a>
      <a href="register.html">Register</a>
      <a href="contact.php" class="active">Contact</a>
    </nav>
  </header>

  <main>
    <section class="page-hero">
      <span class="eyebrow">✉️ Get in touch</span>
      <h1>Questions?<br>We've got <span>answers.</span></h1>
      <p class="lede">Whether it's about registration, sponsorship or the schedule — send us a message and the committee will get back to you.</p>
    </section>

    <div class="contact-layout">
      <div>
        <?php if ($justSent): ?>
          <div class="alert alert-success">
            <strong>Message sent.</strong> Thanks for reaching out — a committee member will reply to your email soon.
          </div>
          <a href="contact.php" class="btn btn-ghost">Send another message</a>
        <?php else: ?>

          <?php if ($errors): ?>
            <div class="alert alert-error">
              <strong>Please fix the following:</strong>
              <ul style="margin:8px 0 0; padding-left:20px;">
                <?php foreach ($errors as $err): ?>
                  <li><?= h($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form class="panel" action="contact.php" method="POST" novalidate>
            <div class="field-grid">
              <div class="field">
                <label for="name">Full name</label>
                <input id="name" name="name" type="text" placeholder="e.g. Aarav Sharma" value="<?= old('name') ?>" required>
              </div>
              <div class="field">
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" placeholder="you@example.com" value="<?= old('email') ?>" required>
              </div>
              <div class="field">
                <label for="phone">Phone number</label>
                <input id="phone" name="phone" type="tel" pattern="[0-9]{10}" placeholder="10-digit number" value="<?= old('phone') ?>" required>
              </div>
              <div class="field">
                <label for="subject">Subject</label>
                <select id="subject" name="subject" required>
                  <option value="" disabled <?= old('subject') ? '' : 'selected' ?>>Select a topic</option>
                  <?php
                    $topics = ['General inquiry','Registration help','Sponsorship / partnership','Media & press','Volunteering','Other'];
                    foreach ($topics as $t):
                  ?>
                    <option value="<?= h($t) ?>" <?= old('subject') === h($t) ? 'selected' : '' ?>><?= h($t) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="field full">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="How can we help?" required><?= old('message') ?></textarea>
              </div>
            </div>
            <div class="form-nav">
              <span class="hint">We typically reply within 1–2 working days.</span>
              <button type="submit" class="btn btn-primary">Send message →</button>
            </div>
          </form>

        <?php endif; ?>
      </div>

      <aside>
        <div class="section-tag">Other ways to reach us</div>
        <div class="info-card">
          <div class="k">Email</div>
          <div class="v">sportsmeet2026@example.com</div>
        </div>
        <div class="info-card">
          <div class="k">Venue</div>
          <div class="v">City Sports Complex, MG Road, Pune</div>
        </div>
        <div class="info-card">
          <div class="k">Office hours</div>
          <div class="v">Mon–Fri, 10 AM – 5 PM</div>
        </div>
      </aside>
    </div>
  </main>

  <footer>
    <span>© 2026 Annual Sports Meet Committee</span>
    <span>Need help? sportsmeet2026@example.com</span>
  </footer>

</body>
</html>
