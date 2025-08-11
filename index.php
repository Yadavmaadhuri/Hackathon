<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDC Hackathon 2025 | Innovation Challenge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="assets/images/hackathon.png" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        :root {
            --primary: #2a3b90;
            --primary-light: #3a4da8;
            --primary-dark: #1a2b70;
            --secondary: #f05d23;
            --secondary-light: #ff6b2b;
            --secondary-dark: #d04a1a;
            --accent: #6bd3e0;
            --accent-dark: #4bc5d4;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.12);
            --shadow-heavy: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: white;
            color: var(--dark);
            line-height: 1.7;
            overflow-x: hidden;
        }

        .container {
            /* max-width: 1200px; */
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Loading Animation */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            transition: opacity 0.5s ease;
        }

        .loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loader-content {
            text-align: center;
            color: white;
        }

        .loader-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Enhanced Header */
        .main-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-light);
            position: fixed;
            width: 100%;
            z-index: 1000;
            transition: var(--transition);
        }

        .main-header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-medium);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            transition: var(--transition);
        }

        .main-header.scrolled .header-content {
            padding: 15px 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo span {
            color: var(--secondary);
        }

        .logo::before {
            content: '⚡';
            margin-right: 8px;
            font-size: 1.5rem;
        }

        .nav-links {
            display: flex;
            gap: 35px;
            align-items: center;
        }

        .nav-links a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: var(--transition);
            position: relative;
            padding: 8px 0;
        }

        .nav-links a:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: var(--transition);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .btn-outline::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--primary);
            transition: var(--transition);
            z-index: -1;
        }

        .btn-outline:hover::before {
            left: 0;
        }

        .btn-outline:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-light);
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 5px;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--primary);
            margin: 3px 0;
            transition: var(--transition);
        }

        /* .mobile-menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        } */


        /* Mobile dropdown menu */
        .mobile-menu {
            position: absolute;
            /* anchor to header */
            top: 60px;
            /* adjust to match your header height */
            right: 10px;
            /* small gap from right edge */
            width: 200px;
            /* compact width */
            background: white;
            box-shadow: var(--shadow-heavy);
            border-radius: 8px;
            overflow: hidden;
            max-height: 0;
            /* start closed */
            opacity: 0;
            /* invisible when closed */
            transition: max-height 0.3s ease, opacity 0.3s ease;
            z-index: 999;
        }

        /* Open state */
        .mobile-menu.active {
            max-height: 300px;
            /* just enough for links */
            opacity: 1;
        }

        /* Menu links */
        .mobile-menu a {
            display: block;
            padding: 12px 15px;
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px solid var(--light-gray);
            background: white;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .mobile-menu a:last-child {
            border-bottom: none;
            /* no border on last link */
        }

        .mobile-menu a:hover {
            color: var(--primary);
            background: gray;
        }

        /* Enhanced Hero Section */
        .hero {
            padding-top: 120px;
            background: linear-gradient(135deg, #f5f7ff 0%, #e8ecff 100%);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 60px;
            padding: 80px 0;
            position: relative;
            z-index: 2;
        }

        .hero-text {
            animation: slideInLeft 1s ease-out;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 25px;
            color: var(--primary);
            line-height: 1.1;
            position: relative;
        }

        .hero-title span {
            color: var(--secondary);
            position: relative;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
            border-radius: 2px;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--gray);
            margin-bottom: 35px;
            font-weight: 400;
            line-height: 1.6;
        }

        .hero-stats {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-light);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-light));
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 6px 20px rgba(240, 93, 35, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(240, 93, 35, 0.4);
        }

        .hero-image {
            position: relative;
            animation: slideInRight 1s ease-out;
        }

        .hero-image img {
            width: 100%;
            border-radius: 20px;
            box-shadow: var(--shadow-heavy);
            transform: perspective(1000px) rotateY(-10deg);
            transition: var(--transition);
        }

        .hero-image:hover img {
            transform: perspective(1000px) rotateY(-5deg) scale(1.02);
        }

        .hero-image::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            border-radius: 50%;
            opacity: 0.1;
            z-index: -1;
        }

        .hero-image::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            opacity: 0.1;
            z-index: -1;
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .floating-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Enhanced Features Section */
        .section {
            padding: 120px 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 80px;
            position: relative;
        }

        .section-title h2 {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
            font-weight: 800;
            position: relative;
        }

        .section-title p {
            color: var(--gray);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 100px;
            height: 5px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
            margin: 30px auto 0;
            border-radius: 3px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin-bottom: 80px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: var(--transition);
        }

        .feature-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(107, 211, 224, 0.05) 0%, transparent 70%);
            transition: var(--transition);
            z-index: -1;
        }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-heavy);
        }

        .feature-card:hover::before {
            height: 12px;
        }

        .feature-card:hover::after {
            top: -25%;
            right: -25%;
        }

        .feature-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(42, 59, 144, 0.1), rgba(107, 211, 224, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 2.5rem;
            transition: var(--transition);
            position: relative;
        }

        .feature-card:hover .feature-icon {
            background: linear-gradient(135deg, rgba(240, 93, 35, 0.1), rgba(107, 211, 224, 0.1));
            transform: scale(1.1) rotate(5deg);
        }

        .feature-icon::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .feature-card:hover .feature-icon::before {
            opacity: 0.1;
        }

        .feature-title {
            font-size: 1.6rem;
            margin-bottom: 20px;
            color: var(--primary);
            font-weight: 700;
        }

        .feature-text {
            color: var(--gray);
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* Enhanced Info Section */
        .info-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjAzKSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
            opacity: 0.5;
        }

        .info-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .info-title {
            font-size: 2.5rem;
            margin-bottom: 50px;
            font-weight: 700;
        }

        .remember-list {
            list-style-type: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            text-align: left;
        }

        .remember-list li {
            padding: 20px 20px 20px 60px;
            position: relative;
            margin-bottom: 10px;
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }

        .remember-list li:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(10px);
        }

        .remember-list li::before {
            content: '✓';
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            font-weight: bold;
            font-size: 1.5rem;
            width: 30px;
            height: 30px;
            background: rgba(107, 211, 224, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Enhanced CTA Section */
        .cta-section {
            padding: 120px 0;
            background: linear-gradient(135deg, var(--light-gray) 0%, #f0f2f5 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(42, 59, 144, 0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: 2.8rem;
            color: var(--primary);
            margin-bottom: 25px;
            font-weight: 800;
        }

        .cta-text {
            color: var(--gray);
            font-size: 1.2rem;
            margin-bottom: 50px;
            line-height: 1.7;
        }

        /* Countdown Timer */
        .countdown {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 50px 0;
        }

        .countdown-item {
            text-align: center;
            background: white;
            padding: 25px 20px;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            min-width: 100px;
        }

        .countdown-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            display: block;
            font-family: 'JetBrains Mono', monospace;
        }

        .countdown-label {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Enhanced Footer */
        footer {
            background: linear-gradient(135deg, var(--dark) 0%, #1a1d23 100%);
            color: white;
            padding: 80px 0 40px;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjAyKSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
            opacity: 0.5;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            margin-bottom: 60px;
            position: relative;
            z-index: 2;
        }

        .footer-logo {
            text-decoration: none;
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            margin-bottom: 25px;
            display: inline-block;
            transition: var(--transition);
        }

        .footer-logo:hover {
            transform: scale(1.05);
        }

        .footer-logo span {
            color: var(--accent);
        }

        .footer-logo::before {
            content: '⚡';
            margin-right: 10px;
            font-size: 1.8rem;
            text-decoration: none;
        }

        .footer-about p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-link:hover {
            background: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(107, 211, 224, 0.4);
        }

        .footer-links h3 {
            color: white;
            font-size: 1.3rem;
            margin-bottom: 25px;
            font-weight: 700;
            position: relative;
        }

        .footer-links h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 30px;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }

        .footer-links ul {
            list-style-type: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            font-size: 1rem;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--accent);
            padding-left: 8px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
            position: relative;
            z-index: 2;
        }

        /* Scroll to Top Button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(42, 59, 144, 0.4);
        }

        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 50px;
            }

            .hero-image {
                order: -1;
                max-width: 600px;
                margin: 0 auto;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-stats {
                justify-content: center;
            }

            .remember-list {
                grid-template-columns: 1fr;
            }

            .countdown {
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title h2 {
                font-size: 2.2rem;
            }

            .feature-card {
                padding: 40px 30px;
            }

            .hero-stats {
                flex-direction: column;
                align-items: center;
            }

            .countdown {
                flex-wrap: wrap;
                gap: 15px;
            }

            .countdown-item {
                min-width: 80px;
                padding: 20px 15px;
            }

            .footer-content {
                display: flex;
                flex-wrap: wrap;
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
            }

            .remove-btn {
                font-size: 9px;
                padding: 0 3px;
                top: 2.5px;
                right: 2.5px;
            }



        }

        @media (max-width: 576px) {
            .hero {
                padding-top: 100px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .section {
                padding: 80px 0;
            }

            .container {
                padding: 0 15px;
            }

            .btn-primary {
                padding: 12px 30px;
                font-size: 1rem;
            }

            .cta-title {
                font-size: 2.2rem;
            }





        }
    </style>
</head>

<body>

    <div>
        <!-- Header -->
        <header class="main-header" id="header">
            <div class="container">
                <div class="header-content">
                    <a href="#" class="logo">HDC<span>Hackathon</span></a>
                    <nav class="nav-links">
                        <a href="#home">Home</a>
                        <a href="#features">Features</a>
                        <a href="#guidelines">Guidelines</a>
                        <a href="registration/register">Register</a>
                        <a href="#contact">Contact</a>
                        <!--<a href="registration/register" class="btn-outline">Register</a>-->
                    </nav>
                    <div class="mobile-menu-toggle" id="mobileToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <!-- mobile menu -->
            <div class="mobile-menu" id="mobileMenu">
                <a href="#home">Home</a>
                <a href="#features">Features</a>
                <a href="#guidelines">Guidelines</a>
                <a href="registration/register">Register</a>
                <a href="#contact">Contact</a>

            </div>
        </header>
    </div>

    <!-- Hero Section -->
    <section class="hero" id="home">

        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">HDC Hackathon <span>2025</span></h1>
                    <p class="hero-subtitle">Join the most exciting innovation challenge of the year. Collaborate with
                        brilliant minds, build groundbreaking solutions, and compete for amazing prizes.</p>


                    <a href="registration/register" class="btn-primary" style="text-decoration:none;;">
                        <span>Register Your Team</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="hero-image">
                    <img src="assets/images/hero.jpeg" alt="Hackathon participants collaborating">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Participate?</h2>
                <p>Join thousands of innovators in this premier hackathon experience with unique opportunities and
                    cutting-edge technology</p>
            </div>

            <div class="features">
                <div class="feature-card fade-in-up">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Team Management</h3>
                    <p class="feature-text">Register your team of exactly 4 members and manage all details through our
                        intuitive dashboard with real-time collaboration tools.</p>
                </div>

                <div class="feature-card fade-in-up">
                    <div class="feature-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h3 class="feature-title">Secure Uploads</h3>
                    <p class="feature-text">Submit required documents with our validated upload system that includes
                        live previews, file checks, and secure cloud storage.</p>
                </div>

                <div class="feature-card fade-in-up">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="feature-title">Instant Notifications</h3>
                    <p class="feature-text">Get real-time SMS confirmations and team approval status updates through our
                        secure gateway with 24/7 monitoring.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section" id="guidelines">
        <div class="container">
            <div class="info-content">
                <h3 class="info-title">Registration Guidelines</h3>
                <ul class="remember-list">
                    <li>Each team must consist of exactly 4 members with diverse skill sets</li>
                    <li>Upload recent photos and 12th admit cards (JPEG/PDF under 200kB)</li>
                    <li>Team leader creates account to manage team status and communications</li>
                    <li>Unique Team ID generated upon successful submission and verification</li>
                    <li>Admin verification required before approval with 24-48 hour processing</li>
                    <li>SMS notifications sent for registration and approval confirmations</li>
                    <li>Registration deadline: October 15, 2025 at 11:59 PM IST</li>
                    <li>All team members must be present during the event check-in</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <a href="#" class="footer-logo">HDC<span>Hackathon</span></a>
                    <p>The premier hackathon event fostering innovation and collaboration among the brightest minds
                        since 2015. Join us in shaping the future of technology.</p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/share/19VNBxMkFK/" class="social-link"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/hdc.college?igsh=MWV2Z2xwN3czMGdzMg==" class="social-link"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/himalayacollege/" class="social-link"><i
                                class="fab fa-linkedin"></i></a>
                        <!-- <a href="#" class="social-link"><i class="fab fa-github"></i></a> -->
                        <!-- <a href="#" class="social-link"><i class="fab fa-twitter"></i></a> -->
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#guidelines">Guidelines</a></li>
                        <li><a href="registration/register">Register</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="#">Rules & Regulations</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Judging Criteria</a></li>
                        <li><a href="#">Past Winners</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Contact</h3>
                    <ul>
                        <li><a href="mailto:info@hdchack.com">Email Us</a></li>
                        <li><a href="#">Sponsorship</a></li>
                        <li><a href="#">Volunteer</a></li>
                        <li><a href="#">Media Kit</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                © 2025 HDC Hackathon Committee. All rights reserved. | Privacy Policy | Terms of Service
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
        // Loading Screen
        window.addEventListener('load', function () {
            setTimeout(() => {
                document.getElementById('loader').classList.add('hidden');
            }, 1500);
        });

        // Header Scroll Effect
        window.addEventListener('scroll', function () {
            const header = document.getElementById('header');
            const scrollTop = document.getElementById('scrollTop');

            if (window.scrollY > 100) {
                header.classList.add('scrolled');
                scrollTop.classList.add('visible');
            } else {
                header.classList.remove('scrolled');
                scrollTop.classList.remove('visible');
            }
        });

        // Mobile Menu Toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileToggle.addEventListener('click', function () {
            mobileToggle.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on links
        document.querySelectorAll('.mobile-menu a').forEach(link => {
            link.addEventListener('click', function () {
                mobileToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
            });
        });

        // Smooth Scrolling
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Scroll to Top
        document.getElementById('scrollTop').addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('[data-count]');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 16);
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('fade-in-up')) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }

                    // Animate counters when hero section is visible
                    if (entry.target.id === 'home') {
                        setTimeout(animateCounters, 500);
                    }
                }
            });
        }, observerOptions);

        // Observe elements
        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s ease-out';
            observer.observe(el);
        });

        observer.observe(document.getElementById('home'));

        // Countdown Timer
        function updateCountdown() {
            const eventDate = new Date('2025-10-15T23:59:59').getTime();
            const now = new Date().getTime();
            const timeLeft = eventDate - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = days.toString().padStart(2, '0');
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            } else {
                document.getElementById('countdown').innerHTML = '<h3 style="color: var(--secondary);">Registration Closed!</h3>';
            }
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Modal Functions (placeholder)
        function openLoginModal() {
            alert('Login modal would open here! This would connect to your authentication system.');
        }

        function openRegistrationModal() {
            alert('Registration modal would open here! This would show the detailed registration form.');
        }

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add parallax effect to floating elements
        window.addEventListener('scroll', function () {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelectorAll('.floating-element');
            const speed = 0.5;

            parallax.forEach(element => {
                const yPos = -(scrolled * speed);
                element.style.transform = translateY(${ yPos }px);
            });
        });

        // Add hover effects to feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-15px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.btn-primary, .btn-outline').forEach(button => {
            button.addEventListener('click', function (e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;

                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

    </script>
    <!-- for menu toggle -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const mobileToggle = document.getElementById('mobileToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            if (mobileToggle && mobileMenu) {
                mobileToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    mobileToggle.classList.toggle('active');
                    mobileMenu.classList.toggle('active');
                });

                document.querySelectorAll('.mobile-menu a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                    });
                });

                document.addEventListener('click', (e) => {
                    if (!mobileMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                        mobileToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                    }
                });

                document.querySelectorAll('.mobile-menu a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                    });
                });

                document.addEventListener('click', (e) => {
                    if (!mobileMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                        mobileToggle.classList.remove('active');
                        mobileMenu.classList.remove('active');
                    }
                });
            }
        });
    </script>

</body>

</html>