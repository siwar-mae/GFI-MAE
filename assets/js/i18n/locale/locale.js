import {LocalStorage} from "../../utils/LocalStorage/index";
import Me from "../../utils/api/user/Me.ts";

let locale = 'en';

(async () => {
  try {
    let response = await Me.get({redirect: false});
    try {
      LocalStorage.setLocale(response.locale);
    } catch (exception) {
      console.log('exception');
      console.log(exception);
    }
  } catch (exception) {
    console.log('exception');
    console.log(exception);
  }
})();


if(LocalStorage.getLocale() !== ''){
  locale = LocalStorage.getLocale();
} else {
  LocalStorage.setLocale(locale);
}

export default locale
