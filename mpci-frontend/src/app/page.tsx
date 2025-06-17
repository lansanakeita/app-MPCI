'use client';

import { Suspense, useEffect, useState } from 'react';
import IntroSection from "./features/home/components/IntroSection";
import { EvenementDTO } from './features/evenements/types';
import { fetchEvenementActif } from './features/evenements/api';
import PanelSection from './features/home/components/PanelSection';
import ProgrammeCarousel from '@/components/ProgrammeCarousel';
import PanelSectionAdapted from './features/evenements/components/PanelsPresentation';

import React from 'react';
import { useToast } from '@/components/ToastProvider';

export default function Home() {
  
  const [evenement, setEvenement] = useState<EvenementDTO>();
  const toast = useToast();

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
      .catch(() => {
          toast({ type: 'error', message: ' Erreur lors de la récupération des événements.' });
      })
  }, [toast]);

  return (
     <Suspense fallback={
            <div className="min-h-screen bg-gray-50 font-inter">
              <div className="flex items-center justify-center py-16">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
                <span className="ml-3 text-gray-600">Chargement des événements...</span>
              </div>
            </div>
          }>
            <main className="flex flex-col gap-4">
            <IntroSection evenement={evenement}/>
            {evenement && <PanelSectionAdapted evenement={evenement} />}
            <ProgrammeCarousel images={programmeImages} />
            <PanelSection panelists={allPanelists} />
          </main>
        </Suspense>
    
  );
}
