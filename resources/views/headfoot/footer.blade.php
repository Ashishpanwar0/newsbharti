{{-- Samachar Bharti Footer --}}
<footer class="sb-footer">
    <div class="sb-footer-main">
        <div class="sb-footer-grid">

            {{-- About --}}
            <div class="sb-footer-column">
                <h3 class="sb-footer-heading">Samachar Bharti</h3>

                <p class="sb-footer-description">
                    Samachar Bharti par padhein latest aur breaking news.
                    Desh, rajya, rajneeti, business, education, sports aur
                    anya mahatvapurn khabron ki jaankari paayein.
                </p>

                <div class="sb-social-links">
                    <a href="https://www.facebook.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="https://x.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="X">
                        <i class="bi bi-twitter-x"></i>
                    </a>

                    <a href="https://www.youtube.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>

                    <a href="https://www.instagram.com/" target="_blank"
                       rel="noopener noreferrer" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>

            {{-- Latest News --}}
            <div class="sb-footer-column">
                <h3 class="sb-footer-heading">Latest News</h3>

                <ul class="sb-footer-list">
                    <li>
                        <a href="{{ url('/') }}">Latest News</a>
                    </li>
                    <li>
                        <a href="{{ url('/category/uttarakhand-news') }}">
                            Uttarakhand News
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/category/uttarakhand-news') }}">
                            Dehradun News
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/category/uttarakhand-news') }}">
                            Haridwar News
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Top Categories --}}
            <div class="sb-footer-column">
                <h3 class="sb-footer-heading">More About</h3>

                <ul class="sb-footer-list">
                    <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ url('/about-us') }}">About Us</a></li>
                    <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                    <!-- <li><a href="{{ url('/') }}"></a></li> -->
                </ul>
            </div>

            {{-- Downloads --}}
            <div class="sb-footer-column sb-footer-downloads">
                <h3 class="sb-footer-heading">Downloads</h3>

                <p class="sb-download-text">
                    Stay connected with Samachar Bharti.
                </p>

                {{-- Add your real app link and badge image here when available. --}}
                <span class="sb-app-coming-soon">
                    App information coming soon
                </span>
            </div>

        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="sb-footer-bottom">
        <p class="sb-copyright">
            &copy; {{ date('Y') }} Samachar Bharti. All Rights Reserved.
        </p>

        <p class="sb-footer-credit">
            Designed &amp; Developed by
            <span>Ashish Panwar</span>
        </p>
    </div>
</footer>

<style>
    .sb-footer {
        width: 100%;
        margin-top: 40px;
        color: #111827;
        background: #ffffff;
        font-family: inherit;
    }

    .sb-footer * {
        box-sizing: border-box;
    }

    .sb-footer-main {
        width: 100%;
        padding: 42px 24px 32px;
    }

    .sb-footer-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 36px;
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }

    .sb-footer-column {
        min-width: 0;
    }

    .sb-footer-heading {
        position: relative;
        margin: 0 0 22px;
        padding-left: 20px;
        color: #111827;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.5;
    }

    .sb-footer-heading::before {
        position: absolute;
        top: 4px;
        left: 0;
        width: 10px;
        height: 15px;
        background: #f5a900;
        content: "";
    }

    .sb-footer-description {
        margin: 0;
        color: #374151;
        font-size: 14px;
        line-height: 1.8;
    }

    .sb-footer-list {
        margin: 0;
        padding-left: 18px;
    }

    .sb-footer-list li {
        margin-bottom: 13px;
        padding-left: 2px;
        color: #333333;
        font-size: 14px;
    }

    .sb-footer a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .sb-footer-list a:hover,
    .sb-footer-nav a:hover {
        color: #e51b23;
    }

    .sb-social-links {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
    }

    .sb-social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border: 1px solid #e5e7eb;
        border-radius: 50%;
        color: #172033;
        font-size: 16px;
    }

    .sb-social-links a:hover {
        border-color: #e51b23;
        color: #e51b23;
    }

    .sb-download-text {
        color: #4b5563;
        font-size: 14px;
        line-height: 1.7;
    }

    .sb-app-coming-soon {
        display: inline-block;
        margin-top: 8px;
        padding: 9px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        color: #4b5563;
        font-size: 13px;
    }

    .sb-footer-bottom {
        padding: 22px 18px 18px;
        background: #171719;
        color: #ffffff;
        text-align: center;
    }

    .sb-copyright {
        margin: 0 0 16px;
        font-size: 13px;
        line-height: 1.7;
    }

    .sb-footer-nav {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px 18px;
        margin: 0 auto 17px;
    }

    .sb-footer-nav a {
        color: #ffffff;
        font-size: 13px;
    }

    .sb-footer-credit {
        margin: 0;
        color: #d1d5db;
        font-size: 13px;
    }

    .sb-footer-credit span {
        color: #ffffff;
        font-weight: 700;
    }

    @media (max-width: 900px) {
        .sb-footer-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 30px 24px;
        }
    }

    @media (max-width: 520px) {
        .sb-footer-main {
            padding: 30px 18px;
        }

        .sb-footer-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 26px;
        }

        .sb-footer-heading {
            margin-bottom: 14px;
        }

        .sb-footer-bottom {
            padding: 22px 14px;
        }

        .sb-footer-nav {
            gap: 12px 15px;
        }
    }
</style>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

