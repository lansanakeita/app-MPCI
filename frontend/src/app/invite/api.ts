

import apiFetch from '@/lib/api';
import { InviteDTO } from './type';


export async function fetchInviteById(id: string): Promise<InviteDTO> {
  const data = await apiFetch<{ invite: InviteDTO }>(`/invite/${id}`);
  return data.invite;
}