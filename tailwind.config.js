import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './app/**/*.php',
        './storage/framework/views/*.php',
    ],
    
    darkMode: 'class', // Enable dark mode
    
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            
            colors: {
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                },
                
                secondary: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                },
            },
            
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'fade-in-up': 'fadeInUp 0.6s ease-out',
                'slide-in-left': 'slideInLeft 0.5s ease-out',
                'bounce-in': 'bounceIn 0.6s ease-out',
                'pulse': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'spin-slow': 'spin 3s linear infinite',
            },
            
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeInUp: {
                    '0%': { 
                        opacity: '0',
                        transform: 'translateY(30px)',
                    },
                    '100%': { 
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
                slideInLeft: {
                    '0%': { 
                        opacity: '0',
                        transform: 'translateX(-30px)',
                    },
                    '100%': { 
                        opacity: '1',
                        transform: 'translateX(0)',
                    },
                },
                bounceIn: {
                    '0%': { 
                        opacity: '0',
                        transform: 'scale(0.3)',
                    },
                    '50%': { 
                        opacity: '1',
                        transform: 'scale(1.05)',
                    },
                    '70%': { 
                        transform: 'scale(0.9)',
                    },
                    '100%': { 
                        opacity: '1',
                        transform: 'scale(1)',
                    },
                },
            },
            
            typography: {
                DEFAULT: {
                    css: {
                        maxWidth: 'none',
                        color: '#374151',
                        lineHeight: '1.7',
                        
                        h1: {
                            color: '#111827',
                            fontWeight: '800',
                            fontSize: '2.25rem',
                        },
                        h2: {
                            color: '#111827',
                            fontWeight: '700',
                            fontSize: '1.875rem',
                        },
                        h3: {
                            color: '#111827',
                            fontWeight: '600',
                            fontSize: '1.5rem',
                        },
                        
                        a: {
                            color: '#3b82f6',
                            textDecoration: 'none',
                            fontWeight: '500',
                            '&:hover': {
                                color: '#1d4ed8',
                                textDecoration: 'underline',
                            },
                        },
                        
                        blockquote: {
                            borderLeftColor: '#3b82f6',
                            backgroundColor: '#f8fafc',
                            padding: '1rem',
                            borderRadius: '0.5rem',
                        },
                        
                        code: {
                            backgroundColor: '#f1f5f9',
                            padding: '0.25rem 0.5rem',
                            borderRadius: '0.375rem',
                            fontSize: '0.875rem',
                            fontWeight: '500',
                        },
                        
                        'code::before': {
                            content: '""',
                        },
                        'code::after': {
                            content: '""',
                        },
                    },
                },
            },
            
            boxShadow: {
                'soft': '0 2px 15px rgba(0, 0, 0, 0.08)',
                'medium': '0 4px 25px rgba(0, 0, 0, 0.12)',
                'strong': '0 8px 35px rgba(0, 0, 0, 0.15)',
                'glow': '0 0 20px rgba(59, 130, 246, 0.5)',
            },
            
            borderRadius: {
                'xl': '1rem',
                '2xl': '1.25rem',
                '3xl': '1.5rem',
            },
            
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '128': '32rem',
            },
        },
    },
    
    plugins: [
        forms,
        require('@tailwindcss/typography'),
    ],
};
