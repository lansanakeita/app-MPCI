'use client';

import Image from "next/image";
import Link from 'next/link';
import { useState } from 'react';


export default function Navbar() {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <nav className="bg-white shadow-sm border-b border-blue-700 sticky top-0 z-50">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between items-center py-2">
                    <div className="flex items-center gap-4">
                        <Image
                            src="/logo2.png"
                            alt="LogoM-Guinée"
                            width={85}  
                            height={85}    
                            priority     
                            className="h-auto w-[85px]"
                        />
                        <div className="w-px h-18 bg-ministere-blue" />
                        <Image
                            src="/logo.png"
                            alt="Logo-Guinée"
                            width={90}  
                            height={90}    
                            priority     
                            className="w-[90px] aspect-square object-contain"
                        />
                    </div>
                    <div className="hidden md:flex gap-6 items-center font-semibold text-sm uppercase">
                        <NavLink href="/">Accueil</NavLink>
                        <NavLink href="/#">Guinée</NavLink>
                        <NavLink href="/evenements">Evènements</NavLink>
                        <NavLink href="/#">Liens utiles</NavLink>
                        <NavLink href="/#">Partenaires</NavLink>
                        <NavLink href="/#">Programme</NavLink>
                        <NavLink href="/#" className="text-red-700">Presse</NavLink>
                    </div>
                    <div className="md:hidden">
                        <button onClick={() => setIsOpen(!isOpen)} className="text-blue-700 focus:outline-none">
                            ☰
                        </button>
                    </div>
                </div>
                {isOpen && (
                    <div className="md:hidden flex flex-col gap-2 mt-2 pb-4 font-semibold text-sm uppercase">
                        <NavLink href="/">Accueil</NavLink>
                        <NavLink href="/#">Guinée</NavLink> 
                        <NavLink href="/evenements">Evènements</NavLink>
                        <NavLink href="/#">Liens utiles</NavLink>
                        <NavLink href="/#">Partenaires</NavLink>
                        <NavLink href="/#">Programme</NavLink>
                        <NavLink href="/#" className="text-red-700">Presse</NavLink>
                    </div>
                )}
            </div>
        </nav>
    );
}

function NavLink({ href, children, className = '' }: { href: string; children: React.ReactNode; className?: string }) {
    return (
        <Link href={href}>
            {/* <span className={`text-blue-700 hover:text-blue-900 transition ${className}`}>{children}</span> */}
            <span className={`text-link transition ${className}`}>{children}</span>
        </Link>
    );
}