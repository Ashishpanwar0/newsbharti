@include('headfoot.header')

<title>About Us | Samachar Bharti</title>
<meta name="description" content="Learn about Samachar Bharti and our aim to provide accessible news and information to readers.">


<style>
/* Layout reset: remove browser's default outer gap and let shared header/footer span full width */
html, body { margin: 0 !important; padding: 0 !important; width: 100%; }
body { overflow-x: hidden; }
header, footer, nav, .navbar, .container-fluid { max-width: 100%; }
.sb-page{--red:#ed101b;--blue:#1239c5;--navy:#15213b;--text:#4b5563;display:block;clear:both;width:calc(100% - 40px);max-width:1180px;margin:26px auto 54px;padding:0;color:var(--navy);font-family:inherit;font-size:16px;line-height:1.7}
.sb-page *{box-sizing:border-box}
.sb-page h1,.sb-page h2,.sb-page h3,.sb-page p{overflow-wrap:anywhere}
.sb-hero{position:relative;isolation:isolate;overflow:hidden;margin:0 0 26px;padding:clamp(25px,4.5vw,50px);border:1px solid #e2e8ff;border-radius:16px;background:#f5f7ff}
.sb-hero:after{content:"";position:absolute;z-index:-1;top:-72px;right:-45px;width:clamp(150px,21vw,245px);aspect-ratio:1;border:36px solid rgba(18,57,197,.07);border-radius:50%;pointer-events:none}
.sb-kicker{display:inline-flex;align-items:center;gap:9px;margin:0 0 14px;color:var(--red);font-size:12px;font-weight:800;letter-spacing:.1em;text-transform:uppercase}
.sb-kicker:before{content:"";width:24px;height:3px;border-radius:5px;background:var(--red)}
.sb-page h1{position:relative;z-index:1;max-width:780px;margin:0 0 13px;color:var(--navy);font-size:clamp(30px,4.4vw,50px);font-weight:800;line-height:1.14;letter-spacing:-.03em}
.sb-lead{position:relative;z-index:1;max-width:740px;margin:0;color:#515d73;font-size:16px;line-height:1.8}
.sb-section-heading{margin:27px 0 15px}
.sb-section-heading h2{margin:0 0 6px;color:var(--navy);font-size:clamp(22px,2.6vw,28px);font-weight:800;line-height:1.3}
.sb-section-heading p{margin:0;color:#667085}
.sb-cards{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
.sb-card{min-width:0;padding:24px;border:1px solid #e7eaf0;border-radius:13px;background:#fff;box-shadow:0 5px 20px rgba(21,33,59,.035)}
.sb-card-icon{display:flex;align-items:center;justify-content:center;width:44px;height:44px;margin:0 0 15px;border-radius:11px;background:#fff0f1;color:var(--red);font-size:21px}
.sb-card h2,.sb-card h3{margin:0 0 9px;color:var(--navy);font-size:18px;font-weight:750;line-height:1.4}
.sb-card p{margin:0;color:var(--text);font-size:14px;line-height:1.8}
.sb-note{margin-top:18px;padding:22px 24px;border-left:4px solid var(--blue);border-radius:10px;background:#f6f8ff}
.sb-note h2{margin:0 0 7px;color:var(--navy);font-size:21px;line-height:1.35}
.sb-note p{margin:0;color:var(--text);font-size:14px;line-height:1.85}
.sb-page a{color:var(--blue);text-decoration:none}
.sb-page a:hover{color:var(--red);text-decoration:underline}
.sb-contact-grid{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(260px,.85fr);gap:20px;align-items:start}
.sb-contact-panel{min-width:0;padding:25px;border:1px solid #e7eaf0;border-radius:14px;background:#fff;box-shadow:0 5px 20px rgba(21,33,59,.035)}
.sb-contact-panel h2{margin:0 0 8px;color:var(--navy);font-size:22px;line-height:1.35}
.sb-contact-panel>p{margin:0 0 18px;color:#667085;font-size:14px;line-height:1.8}
.sb-contact-item{display:flex;gap:13px;padding:15px 0;border-top:1px solid #edf0f5}
.sb-contact-item:first-of-type{border-top:0}
.sb-contact-icon{display:flex;flex:0 0 42px;align-items:center;justify-content:center;width:42px;height:42px;border-radius:10px;background:#f0f4ff;color:var(--blue);font-size:19px}
.sb-contact-item h3{margin:0 0 4px;color:var(--navy);font-size:15px;line-height:1.4}
.sb-contact-item p{margin:0;color:#667085;font-size:13px;line-height:1.7}
.sb-contact-aside{padding:25px;border-radius:14px;background:var(--navy);color:#fff}
.sb-contact-aside h2{margin:0 0 10px;color:#fff;font-size:22px;line-height:1.35}
.sb-contact-aside p{margin:12px 0 0;color:#d7dce6;font-size:14px;line-height:1.8}
.sb-contact-aside a{color:#fff;text-decoration:underline}
.sb-chip{display:inline-block;margin:0 0 14px;padding:6px 11px;border-radius:20px;background:rgba(255,255,255,.1);color:#fff;font-size:12px;font-weight:700}
.sb-policy{padding:clamp(20px,3vw,30px);border:1px solid #e7eaf0;border-radius:14px;background:#fff}
.sb-policy h2{margin:25px 0 8px;color:var(--navy);font-size:19px;line-height:1.4}
.sb-policy h2:first-child{margin-top:0}
.sb-policy p,.sb-policy li{color:var(--text);font-size:14px;line-height:1.85}
.sb-policy p{margin:0 0 12px}
.sb-policy a{color:var(--blue)}
.sb-updated{display:inline-block;margin-top:16px;padding:7px 11px;border-radius:7px;background:#fff0f1;color:#a9141b;font-size:12px;font-weight:700}
@media(max-width:850px){.sb-page{margin-top:22px}.sb-cards{grid-template-columns:repeat(2,minmax(0,1fr))}.sb-contact-grid{grid-template-columns:1fr}}
@media(max-width:580px){.sb-page{width:calc(100% - 24px);margin:16px auto 36px}.sb-hero{margin-bottom:19px;padding:24px 19px;border-radius:12px}.sb-hero:after{top:-60px;right:-95px;border-width:27px}.sb-page h1{font-size:clamp(29px,8vw,36px)}.sb-lead{font-size:14px;line-height:1.75}.sb-section-heading{margin:22px 0 13px}.sb-cards{grid-template-columns:1fr;gap:12px}.sb-card,.sb-contact-panel,.sb-contact-aside{padding:19px}.sb-note{margin-top:13px;padding:18px}.sb-contact-grid{gap:14px}.sb-policy{padding:20px 17px}.sb-policy h2{margin-top:21px;font-size:18px}}
</style>

<main class="sb-page">
    <section class="sb-hero">
        <div class="sb-kicker">About Samachar Bharti</div>
        <h1>News that keeps you connected.</h1>
        <p class="sb-lead">Samachar Bharti brings news and important updates together in one place, helping readers stay informed about the stories that matter to them.</p>
    </section>
    <div class="sb-section-heading">
        <h2>What we are about</h2>
        <p>A straightforward approach to news, information and reader experience.</p>
    </div>
    <section class="sb-cards">
        <article class="sb-card">
            <div class="sb-card-icon"><i class="bi bi-newspaper" aria-hidden="true"></i></div>
            <h2>News &amp; Updates</h2>
            <p>We cover relevant developments and updates across different topics so readers can find information that interests them.</p>
        </article>
        <article class="sb-card">
            <div class="sb-card-icon"><i class="bi bi-bookmark-check" aria-hidden="true"></i></div>
            <h2>Clear Information</h2>
            <p>Our aim is to present content in a simple, readable format that helps readers understand the key points of a story.</p>
        </article>
        <article class="sb-card">
            <div class="sb-card-icon"><i class="bi bi-chat-square-text" aria-hidden="true"></i></div>
            <h2>Reader Feedback</h2>
            <p>Reader feedback and correction requests help us identify content that may need another look.</p>
        </article>
    </section>
    <section class="sb-note">
        <h2>Our approach</h2>
        <p>We aim to present information responsibly and review reported errors when sufficient details are provided. News can develop over time, so readers should consider updates and context when following a story.</p>
    </section>
    <section class="sb-note">
        <h2>Talk to us</h2>
        <p>Have a suggestion or noticed a possible error? Visit our <a href="{{ url('/contact-us') }}">Contact Us page</a> and share the details with our team.</p>
    </section>
</main>
@include('headfoot.footer')
