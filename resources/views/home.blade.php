@extends('layout')

@section('contenido')

<header class="masthead home-header text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Bienvenido a HealthOnline</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Resuelve tus dudas y preocupaciones preguntando a los mejores profesionales de nuestro país sin necesidad de desplazarte.</p>
            <button class="btn btn-primary btn-xl ver-mas">Ver más</button>
          </div>
        </div>
      </div>
    </header>

    <section class="bg-primary primer-bloque" id="about">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">¿Hay algo que te preocupe?</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Es muy común en la gente sentir cierto miedo o rechazo al hecho de acudir a centros médicos ante ciertos síntomas que como consuelo se consideran insignificantes. No temáis en formular vuestras preguntas para que los mejores profesionales respondan.</p>
            <button class="btn btn-light btn-xl saber-mas">Quiero saber más</button>
          </div>
        </div>
      </div>
    </section>

    <section id="line-time" class="segundo-bloque">
      <div class="container">
        <div class="row intro-timeline">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">¿Como puedo comenzar?</h2>
            <h3 class="section-subheading text-muted">Es muy fácil unirte a HealthOnline siguiendo los siguientes pasos</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="timeline">
              <li>
                <div class="timeline-text">
                  <h1>1</h1>
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>Paso número 1</h4>
                    <h4 class="subheading">Registrate en la web</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">No dudes en registrarte según tu rol como un usuario, un profesional médico o una clínica. Los pasos son sencillos, y como usuario te ofrecemos respuestas, y como profesional o clínica, reputación. ¡No es necesaria la confirmación de cuenta!</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-text">
                  <h1>2</h1>
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>Paso número 2</h4>
                    <h4 class="subheading">Accede a la sección de preguntas</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Es simple, puedes ver y acceder a las preguntas, si eres profesional, no dudes en responder y ayudar a los usuarios con dudas, y si eres un usuario, no dudes en preguntar y valorar las respuestas de los profesionales.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-text">
                  <h1>3</h1>
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>Paso número 3</h4>
                    <h4 class="subheading">Ayúdanos a crecer</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Estamos en continua evolución, así que no dudes ni un solo instante en enviarnos tus sugerencias, problemas o dudas a traves de la sección de contacto, mis administradores y yo responderemos lo antes posible.</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-text">
                  <h3>Fin!</h3>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">¿Que ofrecemos?</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-lock text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">Seguridad</h3>
              <p class="text-muted mb-0">Tus datos y privacidad al mejor recaudo</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-users text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">Calidad</h3>
              <p class="text-muted mb-0">Contamos con los mejores profesionales como plantilla inicial</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-refresh text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">Novedades</h3>
              <p class="text-muted mb-0">Una constante mejora de calidad y servicios para ofrecer</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-phone text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">Atención</h3>
              <p class="text-muted mb-0">Nuestros administradores a tu disposición ante cualquier problema</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  

    <section class="bg-dark text-white">
      <div class="container text-center">
        <h2 class="mb-4">¿Quien soy?</h2>
        <p class="mb-0">Soy Francisco Manuel Roldán Pérez, un web developer joven que busca ofrecer y transformar todo conocimiento en lo que a informática se refiere en oportunidades y facilidades para todo el mundo. Este es el comienzo de algo más y mucho mejor.</p>
      </div>
    </section>

    <section id="contact">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Contacta conmigo directamente</h2>
            <hr class="my-4">
            <p class="mb-5">Estoy abierto a cualquier oferta, información y colaboración posible de clínicas o centros médicos que quieran ser parte de HealthOnline</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fa fa-phone fa-3x mb-3 sr-contact"></i>
            <p>616 53 11 42</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">kirtashblog@gmail.com</a>
            </p>
          </div>
        </div>
      </div>
    </section>

    

 @stop
