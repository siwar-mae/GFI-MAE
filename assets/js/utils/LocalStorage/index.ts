export class Storage {
  static unsetAll(): Storage {
    return this;
  }

  static get(key: string): string {
    if (localStorage.getItem(key) !== null && localStorage.getItem(key) !== '' && typeof localStorage.getItem(key) === 'string') {
      return <string>localStorage.getItem(key);
    }
    return '';
  }

  static set(key: string, value: string): Storage {
    if (key !== '' && value !== '') {
      localStorage.setItem(key, value);
    }

    return this;
  }

  static unset(key: string): Storage {
    if (key !== '') {
      localStorage.removeItem(key);
    }

    return this;
  }
}

export class LocalStorage extends Storage{
  static localeKey: string = 'locale'

  static setLocale(locale: string): LocalStorage {
    return LocalStorage.set(LocalStorage.localeKey, locale);
  }

  static getLocale(): string {
    return LocalStorage.get(LocalStorage.localeKey);
  }

  static unsetLocale(): LocalStorage {
    return LocalStorage.unset(LocalStorage.localeKey);
  }

  static unsetAll(): LocalStorage {
    TokenStorage.unsetAll();
    UserStorage.unsetAll();
    LocalStorage.unsetLocale();

    return this;
  }
}

export class TokenStorage extends LocalStorage {
  static apiTokenKey: string = 'api.token'
  static apiTokenRefreshKey: string = 'api.token.refresh'
  static apiTokenPreviewKey: string = 'api.token.preview'
  static apiTokenOriginalKey: string = 'api.token.original'

  static setApiToken(apiToken: string): TokenStorage {
    return LocalStorage.set(TokenStorage.apiTokenKey, apiToken);
  }

  static getApiToken(): string {
    return LocalStorage.get(TokenStorage.apiTokenKey);
  }

  static unsetApiToken(): TokenStorage {
    return LocalStorage.unset(TokenStorage.apiTokenKey);
  }

  static setApiTokenRefresh(ApiTokenRefresh: string): TokenStorage {
    return LocalStorage.set(TokenStorage.apiTokenRefreshKey, ApiTokenRefresh);
  }

  static getApiTokenRefresh(): string {
    return LocalStorage.get(TokenStorage.apiTokenRefreshKey);
  }

  static unsetApiTokenRefresh(): TokenStorage {
    return LocalStorage.unset(TokenStorage.apiTokenRefreshKey);
  }

  static setApiTokenPreview(ApiTokenPreview: boolean|null): TokenStorage {
    return LocalStorage.set(TokenStorage.apiTokenPreviewKey, ApiTokenPreview === true ? 'true' : 'false');
  }

  static getApiTokenPreview(): boolean {
    let preview = LocalStorage.get(TokenStorage.apiTokenPreviewKey);
    return preview === 'true';
  }

  static unsetApiTokenPreview(): TokenStorage {
    return LocalStorage.unset(TokenStorage.apiTokenPreviewKey);
  }

  static setApiTokenOriginal(ApiTokenOriginal: string): TokenStorage {
    return LocalStorage.set(TokenStorage.apiTokenOriginalKey, ApiTokenOriginal);
  }

  static getApiTokenOriginal(): string {
    return LocalStorage.get(TokenStorage.apiTokenOriginalKey);
  }

  static unsetApiTokenOriginal(): TokenStorage {
    return LocalStorage.unset(TokenStorage.apiTokenOriginalKey);
  }

  static unsetAll(): TokenStorage
  {
    TokenStorage.unsetApiToken()
    TokenStorage.unsetApiTokenRefresh();
    TokenStorage.unsetApiTokenPreview();
    TokenStorage.unsetApiTokenOriginal();
    return this;
  }
}

export class UserStorage extends LocalStorage {
  static userKey: string = 'user'

  // eslint-disable-next-line no-undef
  static setUser(user: object): UserStorage {
    if (JSON.stringify(user) !== '{}' && user !== null) {
      return LocalStorage.set(UserStorage.userKey, JSON.stringify(user));
    }

    return this;
  }

  // eslint-disable-next-line no-undef
  static getUser(): object {
    let user = LocalStorage.get(UserStorage.userKey);
    if (user !== '') {
      return JSON.parse(user);
    }
    return {};
  }

  static unsetUser(): UserStorage {
    return LocalStorage.unset(UserStorage.userKey);
  }

  static unsetAll(): LocalStorage
  {
    UserStorage.unsetUser()
    return this;
  }
}
