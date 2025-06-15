'use client';

import { useEffect, useState } from 'react';
import EvenementSection from "./features/evenements/components/EvenementSection";
import IntroSection from "./features/home/components/HeroSection";
import ImageSection from "./features/home/components/ImageSection";
import HeroSection from "./features/home/components/IntroSection";
import { EvenementDTO } from './features/evenements/types';
import { fetchEvenementActif } from './features/evenements/api';
import PanelSection from './features/home/components/PanelSection';
import ProgrammeCarousel from '@/components/ProgrammeCarousel';
import PanelsPresentation from './features/evenements/components/PanelsPresentation';
import PanelSectionAdapted from './features/evenements/components/PanelsPresentation';

import React from 'react';

console.log("React version:", React.version);

export default function Home() {
  
  const [evenement, setEvenement] = useState<EvenementDTO>();
  const [loading, setLoading] = useState(true);

  const allPanelists = Array.from(
    new Map(
      (evenement?.panels || [])
        .flatMap((panel) => panel.panelistes)
        .map((p) => [p.id, {
          id: p.id,
          name: p.nom,
          title: p.poste,
          photoUrl: p.photoUrl,
        }])
    ).values()
  );
  

  const programmeImages = evenement?.programmeImages?.map(
    (img) => img.programmeImageUrl
  ) || [];

  useEffect(() => {
    fetchEvenementActif()
      .then(evenement => {
        setEvenement(evenement);
      })
      .catch(err => {
          console.error('❌ Erreur lors du fetch de lévénement :', err);
      })
      .finally(() => {
          setLoading(false);
      });
  }, []);

  return (
    <main className="flex flex-col gap-4">
      {/* <HeroSection evenement={evenement}/> */}
      <IntroSection evenement={evenement}/>
      {evenement && <PanelSectionAdapted evenement={evenement} />}
      <ProgrammeCarousel images={programmeImages} />
      <PanelSection panelists={allPanelists} />
    </main>
  );
}
