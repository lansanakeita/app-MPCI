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
    const error = new Error(`Erreur lors de l'appel à ${endpoint}`) as Error & { response?: Response };
    error.response = res;
    throw error;
    
  }
  return res.json();
}

export default apiFetch;
