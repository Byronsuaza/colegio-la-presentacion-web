import './MariePoussepin.css';

export default function MariePoussepin() {
  return (
    <section className="marie section section--navy" id="marie-poussepin">
      <div className="container">
        <div className="marie__layout">
          {/* Image Column */}
          <div className="marie__image-col">
            <div className="marie__image-frame">
              <img
                src="/marie_poussepin.png"
                alt="Marie Poussepin, Fundadora de la Presentación"
                className="marie__image"
              />
              <div className="marie__image-caption">
                <span className="marie__image-caption-text">Marie Poussepin</span>
                <span className="marie__image-caption-year">1653 — 1744</span>
              </div>
            </div>

            {/* Decorative Gold Frame Lines */}
            <div className="marie__frame-deco marie__frame-deco--tl" />
            <div className="marie__frame-deco marie__frame-deco--br" />
          </div>

          {/* Text Column */}
          <div className="marie__text-col">
            <span className="eyebrow">Nuestra Fundadora</span>
            <span className="divider-gold" />
            <h2 className="section-title section-title--white">
              Marie Poussepin:<br />
              <em className="marie__title-em">Madre de la Caridad</em>
            </h2>

            <div className="marie__body">
              <p>
                Marie Poussepin nació el <strong>14 de octubre de 1653</strong> en Dourdan, Francia. 
                Fue una mujer visionaria que, desde su juventud, combinó la fe profunda con una 
                inteligencia empresarial extraordinaria, transformando la industria de la seda de 
                su región y generando prosperidad para su comunidad.
              </p>
              <p>
                A los 42 años, respondiendo al llamado de Dios, se entregó totalmente al servicio 
                de los pobres y enfermos, fundando la <em>Congregación de las Dominicas de la 
                Presentación de la Santísima Virgen al Templo</em>, institución que llegaría a 
                más de 40 países en los cinco continentes.
              </p>
              <p>
                Su legado es el fundamento de nuestra identidad: <strong>fe, caridad, servicio 
                y excelencia</strong>. El <strong>Colegio de La Presentación de Neiva</strong> 
                es heredero vivo de este carisma, formando mujeres y hombres capaces de 
                transformar la sociedad desde los valores del Evangelio.
              </p>
            </div>

            {/* Key Facts */}
            <div className="marie__facts">
              <div className="marie__fact">
                <span className="marie__fact-num">1696</span>
                <span className="marie__fact-label">Fundación de la Congregación</span>
              </div>
              <div className="marie__fact">
                <span className="marie__fact-num">+40</span>
                <span className="marie__fact-label">Países con presencia dominica</span>
              </div>
              <div className="marie__fact">
                <span className="marie__fact-num">2021</span>
                <span className="marie__fact-label">Beatificación por S.S. Francisco</span>
              </div>
            </div>

            <a href="#nosotros" className="marie__btn" id="marie-conocer-btn">
              Nuestra Historia
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </section>
  );
}
