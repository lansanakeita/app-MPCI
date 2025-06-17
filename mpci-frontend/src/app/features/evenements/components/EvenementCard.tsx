
import Link from 'next/link';

export interface Evenement {
  id: string;
  titre: string;
  description?: string;
  dateDebut: string;
  lieu?: string;
  imageUrl?: string;
}

export default function EvenementCard({ evenement }: { evenement: Evenement }) {
    return (
      <div className="bg-white shadow-md rounded overflow-hidden flex flex-col">
        <div className="p-4 flex flex-col flex-1">
          <h3 className="text-lg font-bold text-link mb-2">
            {evenement.titre}
          </h3>
          <p className="text-sm text-gray-600 mb-2">
            {new Date(evenement.dateDebut).toLocaleDateString('fr-FR', {
              weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            })}
          </p>
          {evenement.lieu && (
            <p className="text-sm text-gray-500 mb-4">
              📍 {evenement.lieu}
            </p>
          )}
          <Link href={`/evenements/${evenement.id}`} className="mt-auto">
            <button className="bg-ministere-blue-hover text-white py-2 px-4 rounded text-sm w-full">
              Voir plus
            </button>
          </Link>
        </div>
      </div>
    );
  }