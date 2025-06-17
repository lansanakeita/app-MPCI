import Link from 'next/link';
import { ReactNode } from 'react';

type ButtonProps = {
  children: ReactNode;
  onClick?: () => void;
  href?: string;
  variant?: 'primary' | 'secondary';
  className?: string;
  type?: 'button' | 'submit' | 'reset';
};

export default function Button({
  children,
  onClick,
  href,
  variant = 'primary',
  className = '',
  type = 'button',
}: ButtonProps) {
  const baseStyle = `h-10 px-5 text-sm font-medium rounded inline-flex items-center justify-center cursor-pointer`;

  const variants = {
    primary: `bg-ministere-blue-hover text-white hover:bg-ministere-blue`,
    secondary: `bg-gray-200 text-gray-800 hover:bg-gray-300`,
  };

  const finalClass = `${baseStyle} ${variants[variant]} ${className}`;

  if (href) {
    return (
      <Link href={href} className={finalClass}>
        {children}
      </Link>
    );
  }

  return (
    <button onClick={onClick} type={type} className={finalClass}>
      {children}
    </button>
  );
}
