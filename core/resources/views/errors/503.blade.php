<!doctype html>
<title>Sitio Web en mantenimiento</title>
<style>
  *{margin: 0;padding: 0;box-sizing: border-box;}
  body{font: 20px Helvetica, sans-serif; color: #333;text-align: center;}
  article h1{font-size: 50px;max-width: 800px;margin-left: auto;margin-right: auto;margin-bottom: 20px;}
  body img{max-width: 100%;width: auto;height: auto;}
  article > div{display: block; text-align: center;max-width: 1200px; width: 95%; margin: 0 auto;padding: 30px;}
  article > section:first-child img{max-width: 100px;width: auto;padding: 15px 15px 15px 15px;}
  section p{padding: 0;margin: 0;}
  a{color: #dc8100;text-decoration: none;}
  a:hover{color: #333;text-decoration: none;}
</style>
<article>
  <section>
    <img src="{{asset('assets/images/'.$setting->logo)}}" alt="logo_grupocorein" width="100" height="100">
  </section>
  <div>
    <section>
      <h1>Este sitio está actualmente fuera de servicio por mantenimiento!</h1>
      <p>Pedimos disculpas por los inconvenientes causados.</p>
      <p>Casi hemos terminado</p>
    </section>
  </div>
</article>
<img src="{{ asset('assets/images/Utilities') }}/maintenance.png" alt="">