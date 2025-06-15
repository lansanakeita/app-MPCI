
import React from 'react';
import Link from 'next/link';



export default function EvenementDetailPage({ params }: { params: { id: number } }) {
    
    return (
      <main className="max-w-5xl mx-auto px-4 py-10">
         <Link href="/evenements" className="inline-flex items-center text-link hover:underline text-sm font-medium">
            ← Retour
          </Link>

        <h1 className="text-2xl mt-2 font-bold text-link">
          Détail de l'événement 
        </h1>
      </main>
    );
  }
  