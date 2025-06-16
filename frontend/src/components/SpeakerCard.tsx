import Image from 'next/image'
import { Avatar } from 'antd';
import { UserOutlined } from '@ant-design/icons';

type SpeakerCardProps = {
  name: string
  title: string
  photoUrl?: string
}

const SpeakerCard = ({ name, title, photoUrl }: SpeakerCardProps) => {
  return (
    <div className="w-48 rounded-xl shadow-md overflow-hidden bg-white text-center p-3">
      {photoUrl ? (
        <Image
          src={photoUrl}
          alt={name}
          width={190}
          height={190}
         
          className="w-full h-48 object-cover rounded-md transition-transform duration-300 ease-in-out hover:scale-105"
        />
      ) : (
        <div className="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-500 text-sm">
          <Avatar
            icon={<UserOutlined />}
            size={96}
            className="bg-gray-100"
          />
        </div>
      )}
      <div className="mt-3">
        <h3 className="text-md font-semibold">{name}</h3>
        <p className="text-sm text-gray-600">{title}</p>
      </div>
    </div>
  )
}

export default SpeakerCard