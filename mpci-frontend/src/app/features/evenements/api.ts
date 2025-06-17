import apiFetch from '@/lib/api';
import { EvenementDTO, ParticipationPayload } from './types';

export async function fetchEvenements(): Promise<EvenementDTO[]> {
  const data = await apiFetch<{ evenements: EvenementDTO[] }>('/evenements');
  return data.evenements;
}

export async function fetchEvenementActif(): Promise<EvenementDTO> {
  const data = await apiFetch<{ evenement: EvenementDTO }>('/evenement/actif');
  return data.evenement;
}


export async function fetchEvenementById(id: string): Promise<EvenementDTO> {
  const data = await apiFetch<{ evenement: EvenementDTO }>(`/evenement/${id}`);
  return data.evenement;
}


export async function submitParticipation(payload: ParticipationPayload): Promise<void> {
  await apiFetch('/evenement/inscription', {
    method: 'POST',
    body: JSON.stringify(payload),
  });
}