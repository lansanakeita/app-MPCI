'use client';

import Image from "next/image";
import Link from 'next/link';
import { useState } from 'react';


export default function Navbar() {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <nav className="bg-white shadow-sm sticky top-0 z-50">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between items-center py-2">
                    <div className="flex items-center gap-4">
                        <Image
                            src="/logo2.png"
                            alt="LogoM-Guinée"
                            width={85}
                            height={85}
                            priority
                            className="w-12 sm:w-16 md:w-[85px] h-auto"
                        />
                        <div className="w-px h-14 sm:h-16 md:h-18 bg-ministere-blue" />

                        <Image
                            src="/logo.png"
                            alt="Logo-Guinée"
                            width={90}
                            height={90}
                            priority
                            className="w-12 sm:w-16 md:w-[90px] aspect-square object-contain"
                        />
                    </div>
                    <div className="hidden md:flex gap-6 items-center font-semibold text-sm uppercase ">
                        <NavLink href="/">Accueil</NavLink>
                        <NavLink href="/evenements">Evènements</NavLink>
                    </div>
                    <div className="md:hidden">
                    <button 
                        onClick={() => setIsOpen(!isOpen)} 
                            className="text-white text-3xl p-2 bg-ministere-blue rounded-md hover:bg-blue-200 focus:outline-none transition"
                        >
                        ☰
                        </button>
                    </div>
                </div>
                {isOpen && (
                    <div className="md:hidden flex flex-col gap-2 mt-2 pb-4 font-semibold text-sm uppercase">
                        <NavLink href="/">Accueil</NavLink>
                        <NavLink href="/evenements">Evènements</NavLink>
                    </div>
                )}
            </div>
        </nav>
    );
}

function NavLink({ href, children, className = '' }: { href: string; children: React.ReactNode; className?: string }) {
    return (
        <Link href={href}>
            <span className={`text-link transition ${className}`}>{children}</span>
        </Link>
    );
}