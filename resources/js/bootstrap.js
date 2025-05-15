import axios from 'axios';
import Sortable from 'sortablejs';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Sortable = Sortable;