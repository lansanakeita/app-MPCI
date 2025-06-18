'use client';

import { useEffect, useState } from 'react';
import EvenementCard from './EvenementCard';
import { EvenementDTO } from '../types';
import { fetchEvenements } from '../api';
import { useToast } from '@/components/ToastProvider';


export default function EvenementSection() {
  const [evenements, setEvenements] = useState<EvenementDTO[]>([]);
  const [loading, setLoading] = useState(true);
  const toast = useToast();

  useEffect(() => {
    fetchEvenements()
      .then(evenements => {
        setEvenements(evenements);
      })
      .catch(() => {
        toast({ type: 'error', message: 'Une erreur est survenue. Veuillez réessayer.' });
      })
      .finally(() => {
        setLoading(false);
      });
  }, [toast]);


  if (loading) return <p className="text-center py-10 text-link">Chargement...</p>;

  return (
    <section className="max-w-7xl mx-auto px-4 py-12">
      <div className="grid gap-12 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        {evenements.map((evt) => (
          <EvenementCard key={evt.id} evenement={evt} />
        ))}
      </div>
    </section>
  );
}