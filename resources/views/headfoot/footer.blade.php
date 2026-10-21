{{-- Samachar Bharti Footer --}}
<footer class="sb-footer">
    <div class="sb-footer-main">
        <div class="sb-footer-grid">

            {{-- Brand --}}
            <div class="sb-footer-column sb-footer-brand-column">
                <a class="sb-footer-brand" href="{{ url('/') }}" aria-label="Samachar Bharti home">
                    <span class="sb-footer-logo" aria-hidden="true">SB</span>
                    <span class="sb-footer-brand-name">Samachar <span>Bharti</span></span>
                </a>

                <p class="sb-footer-description">
                    Samachar Bharti par padhein latest aur breaking news.
                    Desh, rajya, rajneeti, business, education, sports aur
                    anya mahatvapurn khabron ki jaankari paayein.
                </p>

                <div class="sb-social-links" aria-label="Social media">
                    <a href="https://www.facebook.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="Facebook">
                        <i class="bi bi-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="https://x.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="X">
                        <i class="bi bi-twitter-x" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.youtube.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="YouTube">
                        <i class="bi bi-youtube" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="Instagram">
                        <i class="bi bi-instagram" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            {{-- Latest News --}}
            <div class="sb-footer-column">
                <h3 class="sb-footer-heading">Latest News</h3>
                <ul class="sb-footer-list">
                    <li><a href="{{ url('/') }}">Latest News</a></li>
                    <li><a href="{{ url('/category/uttarakhand-news') }}">Uttarakhand News</a></li>
                    <li><a href="{{ url('/category/uttarakhand-news') }}">Dehradun News</a></li>
                    <li><a href="{{ url('/category/uttarakhand-news') }}">Haridwar News</a></li>
                </ul>
            </div>

            {{-- More About --}}
            <div class="sb-footer-column">
                <h3 class="sb-footer-heading">More About</h3>
                <ul class="sb-footer-list">
                    <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ url('/about-us') }}">About Us</a></li>
                    <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                </ul>
            </div>

            {{-- Downloads --}}
            <div class="sb-footer-column sb-footer-downloads">
                <h3 class="sb-footer-heading">Downloads</h3>
                <p class="sb-download-text">Stay connected with Samachar Bharti.</p>
                <span class="sb-app-coming-soon">
                    <i class="bi bi-phone" aria-hidden="true"></i>
                    App information coming soon
                </span>
            </div>

        </div>
    </div>

    <div class="sb-footer-bottom">
        <p class="sb-copyright">
            &copy; {{ date('Y') }} Samachar Bharti. All Rights Reserved.
        </p>
        <p class="sb-footer-credit">
            Designed &amp; Developed by <span>Ashish Panwar</span>
        </p>
    </div>
</footer>

<style>
    .sb-footer {
        --sb-red: #ed101b;
        --sb-blue: #1239c5;
        --sb-navy: #172033;
        --sb-text: #4b5565;
        --sb-line: #e7eaf0;
        width: 100%;
        margin-top: 48px;
        color: var(--sb-navy);
        background: #fff;
        font-family: inherit;
        border-top: 1px solid var(--sb-line);
    }

    .sb-footer,
    .sb-footer * {
        box-sizing: border-box;
    }

    .sb-footer-main {
        width: 100%;
        padding: 46px 24px 38px;
    }

    .sb-footer-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.45fr) repeat(3, minmax(0, 1fr));
        gap: clamp(24px, 3.2vw, 48px);
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .sb-footer-column {
        min-width: 0;
    }

    .sb-footer-brand {
        display: inline-flex;
        align-items: center;
        gap: 11px;
        margin: 0 0 18px;
        color: var(--sb-navy);
        text-decoration: none;
    }

    .sb-footer-brand:hover {
        color: var(--sb-navy);
    }

    .sb-footer-logo {
        display: inline-grid;
        place-items: center;
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        border-radius: 11px;
        background: var(--sb-red);
        color: #fff;
        font-size: 16px;
        font-weight: 900;
        letter-spacing: -.5px;
        box-shadow: 0 5px 12px rgba(237, 16, 27, .18);
    }

    .sb-footer-brand-name {
        color: var(--sb-navy);
        font-size: 20px;
        font-weight: 850;
        line-height: 1.2;
        letter-spacing: -.45px;
    }

    .sb-footer-brand-name span {
        color: var(--sb-blue);
    }

    .sb-footer-heading {
        position: relative;
        margin: 3px 0 20px;
        padding-left: 16px;
        color: var(--sb-navy);
        font-size: 15px;
        font-weight: 800;
        line-height: 1.5;
    }

    .sb-footer-heading::before {
        position: absolute;
        top: 3px;
        left: 0;
        width: 5px;
        height: 17px;
        border-radius: 3px;
        background: var(--sb-red);
        content: "";
    }

    .sb-footer-description,
    .sb-download-text {
        margin: 0;
        color: var(--sb-text);
        font-size: 13px;
        line-height: 1.85;
    }

    .sb-footer-list {
        display: grid;
        gap: 12px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sb-footer-list li {
        margin: 0;
        color: var(--sb-text);
        font-size: 13px;
        line-height: 1.55;
    }

    .sb-footer a {
        text-decoration: none;
        transition: color .18s ease, background-color .18s ease, border-color .18s ease;
    }

    .sb-footer-list a {
        color: var(--sb-text);
    }

    .sb-footer-list a:hover,
    .sb-footer-list a:focus-visible {
        color: var(--sb-red);
    }

    .sb-social-links {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    .sb-social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border: 1px solid #e2e6ee;
        border-radius: 50%;
        background: #fff;
        color: var(--sb-navy);
        font-size: 15px;
    }

    .sb-social-links a:hover,
    .sb-social-links a:focus-visible {
        border-color: var(--sb-red);
        background: var(--sb-red);
        color: #fff;
        transform: translateY(-2px);
    }

    .sb-app-coming-soon {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
        padding: 10px 12px;
        border: 1px solid var(--sb-line);
        border-radius: 8px;
        background: #f8faff;
        color: #5b6474;
        font-size: 12px;
        line-height: 1.4;
    }

    .sb-app-coming-soon i {
        color: var(--sb-blue);
        font-size: 15px;
    }

    .sb-footer-bottom {
        padding: 22px 18px 20px;
        background: var(--sb-navy);
        color: #fff;
        text-align: center;
    }

    .sb-copyright {
        margin: 0 0 8px;
        color: #f4f6fb;
        font-size: 12px;
        line-height: 1.7;
    }

    .sb-footer-credit {
        margin: 0;
        color: #c8cfdd;
        font-size: 12px;
        line-height: 1.7;
    }

    .sb-footer-credit span {
        color: #fff;
        font-weight: 750;
    }

    .sb-footer a:focus-visible {
        outline: 3px solid rgba(18, 57, 197, .28);
        outline-offset: 3px;
        border-radius: 4px;
    }

    @media (max-width: 900px) {
        .sb-footer-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 34px 28px;
        }

        .sb-footer-brand-column {
            grid-column: 1 / -1;
            max-width: 540px;
        }
    }

    @media (max-width: 520px) {
        .sb-footer {
            margin-top: 32px;
        }

        .sb-footer-main {
            padding: 32px 18px 28px;
        }

        .sb-footer-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 27px;
        }

        .sb-footer-brand-column {
            grid-column: auto;
        }

        .sb-footer-brand-name {
            font-size: 19px;
        }

        .sb-footer-heading {
            margin-bottom: 13px;
        }

        .sb-footer-bottom {
            padding: 20px 14px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .sb-footer a {
            transition: none;
        }
    }
</style>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
