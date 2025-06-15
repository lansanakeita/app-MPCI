// src/app/invite/[id]/page.tsx
import { fetchInviteById } from "../api";
import { notFound } from "next/navigation";
import Image from "next/image";

type Props = {
  params: {
    id: string;
  };
};

export default async function InvitePage({ params }: Props) {
  try {
    const invite = await fetchInviteById(params.id);
    console.log('id', params.id)

    return (
      <div className="flex justify-center px-4 py-10 bg-gray-50 min-h-screen">
        <div className="bg-white shadow-xl rounded-2xl p-8 max-w-4xl w-full">
          {/* Ligne avec photo + infos centrées verticalement */}
          <div className="flex flex-col md:flex-row md:items-center gap-6 mb-8">
            {/* Photo */}
            {invite.photoUrl && (
              <div className="flex-shrink-0">
                <Image
                  src={invite.photoUrl}
                  alt={invite.nom}
                  width={200}
                  height={200}
                  className="rounded-lg object-cover"
                />
              </div>
            )}

            {/* Nom + poste */}
            <div className="text-center md:text-left">
              <h1 className="text-3xl font-bold text-gray-900 mb-2">{invite.nom}</h1>
              <p className="text-lg text-gray-700 italic">{invite.poste}</p>
            </div>
          </div>

          {/* Biographie */}
          <div
            className="prose prose-gray max-w-none"
            dangerouslySetInnerHTML={{ __html: invite.biographie }}
          />
        </div>
      </div>
      // <div className="max-w-3xl mx-auto px-4 py-10">
      //   <h1 className="text-3xl font-bold mb-2">{invite.nom}</h1>
      //   <p className="text-gray-600 text-lg mb-6">{invite.poste}</p>

      //   {invite.photoUrl && (
      //     <div className="mb-6">
      //       <Image
      //         src={invite.photoUrl}
      //         alt={invite.nom}
      //         width={400}
      //         height={400}
      //         className="rounded-lg object-cover"
      //       />
      //     </div>
      //   )}

      //   <div
      //     className="prose prose-lg max-w-none"
      //     dangerouslySetInnerHTML={{ __html: invite.biographie }}
      //   />
      // </div>
    );
  } catch (error) {
    console.error("Erreur fetchInviteById:", error);
    notFound();
  }
}
