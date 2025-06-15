import { fetchEvenementById } from '@/app/features/evenements/api';
import Image from 'next/image';


type Props = {
  params: {
    id: string;
  };
};


export default async function EvenementDetailPage({ params }: Props) {

  const evenement = await fetchEvenementById(params.id);

    
  return (
    <main className="max-w-6xl mx-auto px-6 py-10">

      <h1 className="text-3xl mt-4 font-bold text-link">
        {evenement.titre}
      </h1>
      <p className="mt-2 text-lg font-medium text-gray-700">{evenement.theme}</p>
      <p className="text-sm text-gray-600">{evenement.adresse}, {evenement.ville}, {evenement.pays}</p>

      {evenement?.description && (
        <div
          className="text-justify"
          dangerouslySetInnerHTML={{ __html: evenement.description }}
        />
      )}
      {/* Panels */}
      {evenement.panels.map((panel, index) => (
        <div key={panel.id} className="mt-10 border-t pt-6">
          <h2 className="text-xl font-bold text-gray-800">Panel {index + 1} : {panel.titre}</h2>
          <p className="text-sm text-gray-500 mt-1">{new Date(panel.date).toLocaleDateString()}</p>

          {/* Modérateur */}
          <div className="mt-4">
            <h3 className="font-semibold text-gray-700">Modérateur</h3>
            <div className="flex items-center mt-2 space-x-4">
              {panel?.moderateur?.photoUrl && (
                <Image
                  src={panel.moderateur.photoUrl}
                  alt={panel.moderateur.nom}
                  width={50}
                  height={55}
                  className="rounded-full object-cover"
                />

              )}
              <div>
                <p className="font-medium">{panel?.moderateur?.nom}</p>
                <p className="text-sm text-gray-600">{panel?.moderateur?.poste}</p>
              </div>
            </div>
          </div>

          {/* Panelistes */}
          <div className="mt-6">
            <h3 className="font-semibold text-gray-700">Panelistes</h3>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
              {panel.panelistes.map((p) => (
                <div key={p.id} className="flex items-center space-x-4">
                  {p.photoUrl && (
                    <Image
                      src={p.photoUrl}
                      alt={p.nom}
                      width={50}
                      height={55}
                      className="rounded-full object-cover"
                    />

                  )}
                  <div>
                    <p className="font-medium">{p.nom}</p>
                    <p className="text-sm text-gray-600">{p.poste}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Conférenciers */}
          {panel.conferenciers.length > 0 && (
            <div className="mt-6">
              <h3 className="font-semibold text-gray-700">Conférenciers</h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                {panel.conferenciers.map((c) => (
                  <div key={c.id} className="flex items-center space-x-4">
                    {c.photoUrl && (
                      <Image
                        src={c.photoUrl}
                        alt={c.nom}
                        width={55}
                        height={55}
                        className="rounded-full"
                      />
                    )}
                    <div>
                      <p className="font-medium">{c.nom}</p>
                      <p className="text-sm text-gray-600">{c.poste}</p>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}
        </div>
      ))}
    </main>
  );
}
  