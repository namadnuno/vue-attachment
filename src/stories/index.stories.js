import Vue from 'vue';
import VueAttachments from '../index';

Vue.use(VueAttachments)

export default { title: 'Attachments' };

export const defaultComponent = () => '<v-attachment />';
