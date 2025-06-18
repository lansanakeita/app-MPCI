"use client";

import { createContext, useContext, useState, ReactNode, useCallback } from "react";

type Toast = { id: number; type: "success" | "error"; message: string };

const ToastContext = createContext<(toast: Omit<Toast, "id">) => void>(
  () => {}
);

let toastId = 0;

export function ToastProvider({ children }: { children: ReactNode }) {
    const [toasts, setToasts] = useState<Toast[]>([]);

    const showToast = useCallback((toast: Omit<Toast, "id">) => {
        const id = toastId++;
        setToasts([{ ...toast, id }]);
      
        setTimeout(() => {
          setToasts((prev) => prev.filter((t) => t.id !== id));
        }, 4000);
      }, []);
      

    return (
        <ToastContext.Provider value={showToast}>
        {children}
        <div className="fixed top-4 right-4 space-y-2 z-[9999]">
            {toasts.map((t) => (
            <div
                key={t.id}
                className={`px-4 py-4 rounded shadow text-sm text-white ${
                t.type === "success" ? "bg-green-600" : "bg-red-500"
                }`}
            >
                {t.message}
            </div>
            ))}
        </div>
        </ToastContext.Provider>
    );
}

export const useToast = () => useContext(ToastContext);
