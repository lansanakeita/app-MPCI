import Link from 'next/link';
import { EvenementDTO } from '../types';

import moment from 'moment';
import 'moment/locale/fr';

moment.locale('fr');

export default function EvenementCard({ evenement }: { evenement: EvenementDTO }) {
    return (
      <div className="bg-white shadow-md rounded overflow-hidden flex flex-col">
        <div className="p-4 flex flex-col flex-1">
          <h3 className="text-lg font-bold text-link mb-2">
            {evenement.titre}
          </h3>
          <p className="text-sm text-gray-600 mb-2">
            {moment(evenement.dateDebut).format('dddd D MMMM YYYY')}
          </p>
          {evenement.adresse && (
            <p className="text-sm text-gray-500 mb-4">
              📍 {evenement.adresse}
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