'use client';

import apiFetch from '@/lib/api';
import { EvenementDTO } from './types';

export async function fetchEvenements(): Promise<EvenementDTO[]> {
  const data = await apiFetch<{ evenements: EvenementDTO[] }>('/evenements');
  return data.evenements;
}

export async function fetchEvenementActif(): Promise<EvenementDTO> {
  const data = await apiFetch<{ evenement: EvenementDTO }>('/evenement/actif');
  return data.evenement;
}