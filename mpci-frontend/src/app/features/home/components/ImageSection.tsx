// 'use client';

// import { useEffect, useState } from 'react';
// import { EvenementDTO } from '../../evenements/types';
// import { fetchEvenementActif } from '../../evenements/api';
// import Image from 'next/image';

// export default function ImageSection() {
//     const [evenement, setEvenement] = useState<EvenementDTO>();
//     const [loading, setLoading] = useState(true);

//     useEffect(() => {
//         fetchEvenementActif()
//             .then(evenement => {
//                 setEvenement(evenement);
//             })
//             .catch(err => {
//                 console.error('❌ Erreur lors du fetch de lévénement :', err);
//             })
//             .finally(() => {
//                 setLoading(false);
//             });
//     }, []);

//     return (
//         <section className="max-w-7xl mx-auto px-4 py-8">
//             <div className="border-b-4 border-gray-300">
//                 <Image
//                     src="{evenement?.imageUrl}"
//                     alt="{evenement?.titre}"
//                     loading="lazy"
//                     className="w-full max-w-5xl mx-auto"
//                 />
//             </div>
//         </section>

        

//     );
// }