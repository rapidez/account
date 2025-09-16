import { expect } from '@playwright/test'

export class AccountPage {
    constructor(page) {
        this.page = page
    }

    async setDefaultAddress() {
        await this.page.goto('/account/addresses')
        await this.page.waitForLoadState('networkidle')
        await this.page.getByTestId('address-edit').click()
        await this.page.waitForURL('/account/address/*')
        await this.page.waitForLoadState('networkidle')
        await this.page.check('[name=default_billing]')
        await this.page.check('[name=default_shipping]')
        await this.page.getByTestId('continue').click()
        await this.page.waitForTimeout(200)
        await this.page.waitForLoadState('networkidle')
        await this.page.waitForURL('/account/addresses')
        await this.page.waitForLoadState('networkidle')
    }

    async register() {
        const email = `wayne+${crypto.randomUUID()}@enterprises.com`;
        const password = 'IronManSucks.91939';

        await this.page.goto('/register')
        await this.page.fill('[name=firstname]', 'Bruce')
        await this.page.fill('[name=lastname]', 'Wayne')
        await this.page.fill('[name=email]', email)
        await this.page.fill('[name=password]', password)

        await this.page.getByTestId('continue').click()
        await this.page.waitForLoadState('networkidle')
        await this.page.waitForURL('/account')
        await expect(this.page.getByTestId('account-content')).toContainText('Bruce');
    }
}
