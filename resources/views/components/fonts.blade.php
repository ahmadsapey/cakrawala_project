<!-- Google Fonts: Inter (Body) & Outfit (Heading) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

<script>
    if (typeof tailwind !== 'undefined') {
        tailwind.config = tailwind.config || {};
        tailwind.config.theme = tailwind.config.theme || {};
        tailwind.config.theme.extend = tailwind.config.theme.extend || {};
        tailwind.config.theme.extend.fontFamily = {
            ...tailwind.config.theme.extend.fontFamily,
            sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
            heading: ['Outfit', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
        };
    }
</script>

<style>
    body,
    button,
    input,
    select,
    textarea,
    .font-sans {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
    }

    h1, h2, h3, h4, h5, h6,
    .font-heading,
    h1 *:not(code):not(kbd):not(samp),
    h2 *:not(code):not(kbd):not(samp),
    h3 *:not(code):not(kbd):not(samp),
    h4 *:not(code):not(kbd):not(samp),
    h5 *:not(code):not(kbd):not(samp),
    h6 *:not(code):not(kbd):not(samp) {
        font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
    }
</style>
