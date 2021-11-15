export default class Auth {
    constructor(user) {
        this.user = user;
    }

    roles() {
        return this.user.roles.map(role => role.name);
    }

    permissions() {
        return this.user.permissions.map(permission => permission.name);
    }

    isAdmin() {
        return this.roles().includes("admin");
    }

    // can('permisionName')
    can($permissionName) {
        return this.permissions().includes($permissionName);
    }

    // is ovner('user_id')
    isOwner($user_id) {
        return this.user.id == $user_id;
    }
}
