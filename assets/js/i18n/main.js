import Vue from 'vue'
import vuexI18n from "vuex-i18n";
import store from "../store";
import Locales from "../i18n/locale/vue-i18n-locales.generated";
import {LocalStorage, UserStorage} from "@/utils/LocalStorage";
import Me from "../utils/api/user/Me.ts";

(async () => {
  Vue.use(vuexI18n.plugin, store, {
    moduleName: 'i18n',
    onTranslationNotFound(locale, key) {
      console.warn(`i18n :: Key '${key}' not found for locale '${locale}'`);
    }
  });

  Vue.i18n.add('en', Locales.en);
  Vue.i18n.add('fr', Locales.fr);
  Vue.i18n.add('de', Locales.de);

  try {
    // @todo remove when switch to coreui login instead of symfony login
    let response = await Me.get({redirect: false});
    UserStorage.setUser(response);

    if (UserStorage.getUser().locale !== undefined) {
      LocalStorage.setLocale(UserStorage.getUser().locale);
    }
  } catch (error) {
    console.log('exception');
    console.log(error);
  }

  if (UserStorage.getUser().locale !== undefined) {
    LocalStorage.setLocale(UserStorage.getUser().locale);
  }

  Vue.i18n.set(UserStorage.getUser().locale);
})();
