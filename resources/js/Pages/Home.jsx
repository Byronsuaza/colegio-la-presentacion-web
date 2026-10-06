import React from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '../Components/Navbar';
import Hero from '../Components/Hero';
import AccesosRapidos from '../Components/AccesosRapidos';
import ValorSection from '../Components/ValorSection';
import ComunidadEventos from '../Components/ComunidadEventos';
import OfertaEducativa from '../Components/OfertaEducativa';
import Noticias from '../Components/Noticias';
import PagoEnLinea from '../Components/PagoEnLinea';
import Admisiones from '../Components/Admisiones';
import AdmissionPopup from '../Components/AdmissionPopup';
import Footer from '../Components/Footer';

export default function Home({ heroSlides, noticias, ajustes, eventos }) {
    return (
        <>
            <Head title="Inicio" />
            <AdmissionPopup ajustes={ajustes} />
            <Navbar ajustes={ajustes} />
            <main>
                <Hero slides={heroSlides} ajustes={ajustes} />
                <AccesosRapidos ajustes={ajustes} />
                <ValorSection ajustes={ajustes} />
                <ComunidadEventos eventos={eventos} ajustes={ajustes} />
                <OfertaEducativa ajustes={ajustes} />
                <PagoEnLinea ajustes={ajustes} />
                <Noticias noticias={noticias} />
                <Admisiones ajustes={ajustes} />
            </main>
            <Footer ajustes={ajustes} />
        </>
    );
}
