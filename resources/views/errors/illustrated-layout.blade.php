<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    
    <title>@yield('title', 'Error') - {{ config('app.name', 'HRMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: #f8f9fa;
            color: #2d3748;
            line-height: 1.6;
        }

        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 1100px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        .error-content {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .error-divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
            margin: 1.5rem 0;
        }

        .error-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .error-message {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 1rem;
            line-height: 1.7;
        }

        .error-description {
            font-size: 0.95rem;
            color: #a0aec0;
            margin-bottom: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        .btn-outline {
            background: white;
            color: #667eea;
            border-color: #667eea;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .error-illustration {
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .error-illustration img {
            max-width: 100%;
            height: auto;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .geometric-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .shape-1 {
            width: 150px;
            height: 150px;
            background: #667eea;
            top: 20%;
            right: -30px;
        }

        .shape-2 {
            width: 100px;
            height: 100px;
            background: #764ba2;
            bottom: 20%;
            left: -20px;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            background: #667eea;
            bottom: 10%;
            right: 20%;
        }

        .additional-content {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .search-box {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: #5a67d8;
        }

        .helpful-links {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .helpful-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .helpful-links a:hover {
            color: #764ba2;
        }

        @media (max-width: 768px) {
            .error-card {
                grid-template-columns: 1fr;
            }
            
            .error-illustration {
                order: -1;
                padding: 1.5rem;
            }
            
            .error-code {
                font-size: 5rem;
            }
            
            .error-content {
                padding: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <div class="error-content">
                <div class="error-code">@yield('code', '404')</div>
                <h1 class="error-title">@yield('title', 'Page Not Found')</h1>
                <div class="error-divider"></div>
                <p class="error-message">@yield('message', 'Sorry, the page you are looking for could not be found.')</p>
                <p class="error-description">@yield('description', 'The page might have been removed, had its name changed, or is temporarily unavailable.')</p>
                
                <div class="action-buttons">
                    <a href="{{ app('router')->has('home') ? route('home') : url('/') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Back to Dashboard
                    </a>
                    <a href="javascript:history.back()" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div>

                @hasSection('additional_content')
                    <div class="additional-content">
                        @yield('additional_content')
                    </div>
                @endif

                <div class="additional-content">
                    <p style="font-weight: 600; margin-bottom: 0.5rem;">Quick Search</p>
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Search HRMS...">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <div class="helpful-links" style="margin-top: 1.5rem;">
                        <div>
                            <p style="font-weight: 600; font-size: 0.9rem; margin-bottom: 0.5rem;">Quick Links</p>
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                            <a href="{{ url('/employees') }}" style="margin-left: 1rem;">Employees</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-illustration">
                @yield('image')
                <div class="geometric-shapes">
                    <div class="shape shape-1"></div>
                    <div class="shape shape-2"></div>
                    <div class="shape shape-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple search functionality
        document.querySelector('.search-btn').addEventListener('click', function() {
            const searchTerm = document.querySelector('.search-input').value;
            if (searchTerm) {
                window.location.href = '{{ url('/search') }}?q=' + encodeURIComponent(searchTerm);
            }
        });

        // Enter key search
        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value;
                if (searchTerm) {
                    window.location.href = '{{ url('/search') }}?q=' + encodeURIComponent(searchTerm);
                }
            }
        });
    </script>
</body>
</html>
