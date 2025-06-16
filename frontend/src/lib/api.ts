const BASE_URL = process.env.NEXT_PUBLIC_BASE_URL;

async function apiFetch<T>(endpoint: string, options: RequestInit = {}): Promise<T> {
  const res = await fetch(`${BASE_URL}${endpoint}`, {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      ...options.headers,
    },
    cache: 'no-store',
    ...options,
  });

  if (!res.ok) {
    // const errorText = await res.text(); // Lire le corps de la réponse d'erreur
    // console.error(`Erreur API ${endpoint}:`, res.status, errorText);
    console.log(`Erreur API ${endpoint}:`, res);
    throw new Error(`Erreur lors de l'appel à ${endpoint}`);
  }

  return res.json();
}

export default apiFetch;
