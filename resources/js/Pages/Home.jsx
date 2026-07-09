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
import Footer from '../Components/Footer';

export default function Home({ heroSlides, noticias, ajustes, eventos }) {
    return (
        <>
            <Head title="Inicio" />
            <Navbar ajustes={ajustes} />
            <main>
                <Hero slides={heroSlides} ajustes={ajustes} />
                <AccesosRapidos ajustes={ajustes} />
                <ValorSection />
                <ComunidadEventos eventos={eventos} ajustes={ajustes} />
                <OfertaEducativa />
                <PagoEnLinea ajustes={ajustes} />
                <Noticias noticias={noticias} />
                <Admisiones ajustes={ajustes} />
            </main>
            <Footer ajustes={ajustes} />
        </>
    );
}

