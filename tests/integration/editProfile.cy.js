describe('Create account and', () => {
    it('Change password', () => {
        cy.refreshDatabase()
        cy.visit('/login')
        cy.create('App\\Models\\User',{email:'kekw@example.com',name:'lamo'})
        cy.get('[type="email"]').type('kekw@example.com')
        cy.get('.relative > .p-2').type('password')
        cy.get('.bg-yellow-600').click()
        cy.assertRedirect('/home')
        cy.visit('/profile')
        cy.get(':nth-child(1) > .float-left').click()
        cy.get(':nth-child(2) > .bg-gray-50').type('123456789')
        cy.get(':nth-child(3) > .bg-gray-50').type('123456789')
        cy.get('.top-10').click()
        cy.get('._vue-flash-msg-body').contains('Hasło zostało zmienione')
    });
    it('test old and new password', () => {
        cy.visit('/login')
        cy.get('[type="email"]').type('kekw@example.com')
        cy.get('.relative > .p-2').type('password')
        cy.get('.bg-yellow-600').click()
        cy.get('.break-words').contains('These credentials do not match our records.').should('exist')
        cy.get('.relative > .p-2').clear()
        cy.get('.relative > .p-2').type('123456789')
        cy.get('.bg-yellow-600').click()
        cy.assertRedirect('/home')
    });
    it('change username', () => {
        cy.visit('/login')
        cy.get('[type="email"]').type('kekw@example.com')
        cy.get('.relative > .p-2').type('123456789')
        cy.get('.bg-yellow-600').click()
        cy.assertRedirect('/home')
        cy.visit('/profile')
        cy.wait(2000)
        cy.get(':nth-child(2) > .float-left').click()
        cy.get(':nth-child(3) > .bg-gray-50').type('nowa nazwa')
        cy.get('.top-10').click()
        cy.get('.fill-current').click()
        cy.get('.mt-7 > .flex').contains('nowa nazwa')
        
    });
});