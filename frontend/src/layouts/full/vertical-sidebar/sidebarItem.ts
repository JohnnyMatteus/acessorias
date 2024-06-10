import {
  LayoutDashboardIcon,BorderAllIcon,
  AlertCircleIcon,
  CircleDotIcon,
  BoxMultiple1Icon,
  LoginIcon, MoodHappyIcon, ApertureIcon, UserPlusIcon
} from 'vue-tabler-icons';

export interface menu {
  header?: string;
  title?: string;
  icon?: any;
  to?: string;
  chip?: string;
  BgColor?: string;
  chipBgColor?: string;
  chipColor?: string;
  chipVariant?: string;
  chipIcon?: string;
  children?: menu[];
  disabled?: boolean;
  type?: string;
  subCaption?: string;
}

const sidebarItem: menu[] = [
  { header: 'Features' },
  {
    title: "Produtos",
    icon: AlertCircleIcon,
    BgColor: 'primary',
    to: "/produtos",
  },
  {
    title: "Pedidos",
    icon: CircleDotIcon,
    BgColor: 'primary',
    to: "/pedidos",
  },
  {
    title: "Usuarios",
    icon: BoxMultiple1Icon,
    BgColor: 'primary',
    to: "/usuarios",
  }
];

export default sidebarItem;
