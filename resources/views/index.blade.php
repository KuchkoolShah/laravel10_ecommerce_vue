<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <!-- Swagger UI CSS -->
    <link rel="stylesheet" href="{{ asset('api-docs/swagger-ui.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('api-docs/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('api-docs/favicon-16x16.png') }}" sizes="16x16" />

    <style>
      html {
        box-sizing: border-box;
        overflow-y: scroll;
      }
      *, *:before, *:after {
        box-sizing: inherit;
      }
      body {
        margin: 0;
        background: #fafafa;
      }
    </style>
  </head>

  <body>
    <p>hiii<p>
    <div id="swagger-ui"></div>

    <!-- Swagger UI JS -->
    <script src="{{ asset('api-docs/swagger-ui-bundle.js') }}"></script>
    <script src="{{ asset('api-docs/swagger-ui-standalone-preset.js') }}"></script>

    <script>
      window.onload = function() {
        const ui = SwaggerUIBundle({
          url: "{{ asset('api-docs/swagger.json') }}",
          dom_id: '#swagger-ui',
          deepLinking: true,
          presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
          ],
          plugins: [
            SwaggerUIBundle.plugins.DownloadUrl
          ],
          layout: "StandaloneLayout",
        });

        window.ui = ui;
      }
    </script>
  </body>
</html>
