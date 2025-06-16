import { fetchInviteById } from "../api";
import Image from "next/image";
import { UserOutlined } from '@ant-design/icons';
import { Avatar } from 'antd';

type Props = {
  params: {
    id: string;
  };
};

export default async function InvitePage({ params }: Props) {

  const { id } = await params;
  const invite = await fetchInviteById(id);

  return (
    <div className="flex justify-center px-4 py-10 bg-gray-50 min-h-0">
      <div className="bg-white shadow-xl rounded-2xl p-6 sm:p-8 max-w-4xl w-full flex flex-col">
        {/* Ligne avec photo + infos */}
        <div className="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8">
          {/* Photo ou avatar */}
          <div className="w-40 h-40 relative flex items-center justify-center">
            {invite.photoUrl ? (
              <Image
                src={invite.photoUrl}
                alt={invite.nom}
                fill
                className="rounded-lg object-cover"
              />
            ) : (
              <Avatar
                icon={<UserOutlined />}
                size={160}
                style={{ backgroundColor: '#f0f0f0' }}
              />
            )}
          </div>

          {/* Infos principales */}
          <div className="text-center md:text-left flex-1">
            <h1 className="text-3xl font-bold text-gray-900">{invite.nom}</h1>
            {invite.poste && (
              <p className="text-lg text-gray-700 italic mt-1">{invite.poste}</p>
            )}
          </div>
        </div>

        {/* Biographie */}
        {invite.biographie && (
          <div
            className="prose prose-gray max-w-none"
            dangerouslySetInnerHTML={{ __html: invite.biographie }}
          />
        )}
      </div>
    </div>
  );
}
