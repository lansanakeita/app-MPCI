import { useState } from "react";
import { Button, Tag } from "antd";
import {
  UpOutlined,
  DownOutlined,
  TeamOutlined,
  CalendarOutlined,
  EnvironmentOutlined,
} from "@ant-design/icons";
import moment from "moment";
import { EvenementDTO } from "../types";
import ParticipationModal from "@/components/ParticipationModal";

type Props = {
    evenement: EvenementDTO;
};

export default function PanelSectionAdapted({ evenement }: Props) {
    const [expandedPanelId, setExpandedPanelId] = useState<string | null>(null);
    const [showAll, setShowAll] = useState(false);
    const [modalVisible, setModalVisible] = useState(false);

    const panels = evenement.panels || [];
    const panelsToShow = showAll ? panels : panels.slice(0, 2);

    const formatShortDate = (date: string) => moment(date).format("DD MMM");

    return (
        <div className="w-full max-w-6xl mx-auto bg-white rounded shadow p-6 space-y-6">
            {/* 🔵 En-tête infos événement */}
            <div className="flex flex-wrap justify-between items-center text-sm text-gray-600">
                <div className="flex items-center gap-2">
                <CalendarOutlined />
                <span>
                    {moment(evenement.dateDebut).format("DD MMM")} –{" "}
                    {moment(evenement.dateFin).format("DD MMM YYYY")}
                </span>
                </div>
                <div className="flex items-center gap-2">
                    <EnvironmentOutlined />
                    <span className="font-semibold">
                    {evenement.adresse}, {evenement.ville} - {evenement.pays}
                    </span>
                </div>
                <Button type="default" onClick={() => setModalVisible(true)}>Participer</Button>
                {/* <input 
                    type="button" 
                    value="Participer" 
                    onClick={() => setModalVisible(true)}
                    style={{ border: '2px solid red', zIndex: 999 }} 
                /> */}
                {/* <input
                    type="button"
                    value="Participer"
                    onClick={() => setModalVisible(true)}
                    className="px-4 py-1 text-sm text-black bg-white border border-gray-300 rounded-full cursor-pointer hover:bg-gray-100 transition"
                /> */}



            </div>

            {/* 🔵 Modale de participation */}
            <ParticipationModal
                visible={modalVisible}
                onClose={() => setModalVisible(false)}
                eventId={evenement.id}
            />

            {/* 🔵 Liste des Panels */}
            <div>
                <h4 className="text-base sm:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <TeamOutlined className="text-purple mr-2" />
                    Panels ({panels.length})
                </h4>

                <div className="space-y-3">
                    {panelsToShow.map((panel) => (
                        <div
                            key={panel.id}
                            className="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border-l-4 border-primary transform transition duration-200 hover:scale-[1.02] hover:shadow-md"
                        >
                        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2 gap-2">
                            <h5 className="font-semibold text-gray-900">{panel.titre}</h5>
                            <span className="text-sm text-gray-500">
                            {formatShortDate(panel.date)}
                            </span>
                        </div>
                        <div className="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                            <span>1 modérateur</span>
                        </div>
                        <div className="flex flex-wrap gap-2">
                            <Tag
                                bordered={false}
                                color="default"
                                style={{ borderRadius: 8, fontSize: 12 }}
                            >
                            🎙️ {panel.moderateur?.nom}
                            </Tag>
                        </div>
                        </div>
                    ))}

                    {panels.length > 2 && (
                        <div className="text-center py-3">
                            <Button
                                type="link"
                                size="small"
                                onClick={() => setShowAll(!showAll)}
                                className="text-gray-500 bg-gray-100 px-3 py-1 rounded-full hover:bg-gray-200 flex items-center mx-auto"
                                style={{ fontSize: 14 }}
                            >
                                {showAll ? (
                                <>
                                    <UpOutlined className="mr-1" /> Replier les panels
                                </>
                                ) : (
                                <>
                                    +{panels.length - 2} autre{panels.length > 3 ? "s" : ""}{" "}
                                    panel
                                    <DownOutlined className="ml-1" />
                                </>
                                )}
                            </Button>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
