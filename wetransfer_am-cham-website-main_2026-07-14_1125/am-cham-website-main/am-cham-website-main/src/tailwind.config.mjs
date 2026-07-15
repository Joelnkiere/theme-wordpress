/** @type {import('tailwindcss').Config} */
export default {
    content: ['./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}', './public/**/*.html'],
    theme: {
        extend: {
            fontSize: {
                xs: ['0.75rem', { lineHeight: '1rem', letterSpacing: '-0.01em' }],
                sm: ['0.875rem', { lineHeight: '1.25rem', letterSpacing: '-0.01em' }],
                base: ['1rem', { lineHeight: '1.5rem', letterSpacing: '-0.01em' }],
                lg: ['1.125rem', { lineHeight: '1.75rem', letterSpacing: '-0.01em' }],
                xl: ['1.25rem', { lineHeight: '1.75rem', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '2xl': ['1.5rem', { lineHeight: '2rem', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '3xl': ['1.875rem', { lineHeight: '2.25rem', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '4xl': ['2.25rem', { lineHeight: '2.5rem', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '5xl': ['3rem', { lineHeight: '1', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '6xl': ['3.75rem', { lineHeight: '1', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '7xl': ['4.5rem', { lineHeight: '1', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '8xl': ['5.25rem', { lineHeight: '1', letterSpacing: '-0.01em', fontWeight: 'bold' }],
                '9xl': ['6rem', { lineHeight: '1', letterSpacing: '-0.01em', fontWeight: 'bold' }],
            },
            fontFamily: {
                heading: "Cormorant Garamond",
                paragraph: "Lato"
            },
            colors: {
                primary: '#FFFFFF',
                secondary: '#C5173a',
                accent: '#C5173a',
                background: '#FFFFFF',
                foreground: '#1d2337',
                link: '#1d2337',
                card: '#FFFFFF',
                'card-foreground': '#1d2337',
                muted: '#F5F5F5',
                'muted-foreground': '#5A6B8C',
                'primary-foreground': '#1d2337',
                'secondary-foreground': '#FFFFFF',
                'accent-foreground': '#FFFFFF',
                border: '#E0E0E0',
                destructive: '#DC2626',
                'destructive-foreground': '#FFFFFF'
            },
        },
    },
    future: {
        hoverOnlyWhenSupported: true,
    },
    plugins: [require('@tailwindcss/container-queries'), require('@tailwindcss/typography')],
}
