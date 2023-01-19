beforeEach(()=>{
    cy.refreshDatabase()
    cy.seed()
    cy.visit('/login')
    cy.create('App\\Models\\User',{email:'kekw@example.com',name:'lamo'})
    cy.get('[type="email"]').type('kekw@example.com')
    cy.get('.relative > .p-2').type('password')
    cy.get('.bg-yellow-600').click()
    cy.assertRedirect('/home')
})


describe('MyStations input test', () => {
    it('add few station and test if they are presented', () => {
        cy.get(':nth-child(2) > .my-4 > .items-center > [title="Dodaj do przejechanych"] > .rounded').click()
        cy.get('.items-center > .px-4').click()
        cy.get(':nth-child(3) > .my-4 > .items-center > [title="Dodaj do odwiedzonych"] > .rounded').click()
        cy.get('.items-center > .px-4').click()
        cy.get('.sidebar > .w-full > .rounded-lg').type('Legnica')
        cy.get(':nth-child(2) > .my-4 > .items-center > [title="Dodaj do przejechanych"] > .rounded').click()
        cy.get('.items-center > .px-4').click()
        cy.get(':nth-child(3) > .my-4 > .items-center > [title="Dodaj do odwiedzonych"] > .rounded').click()
        cy.get('.items-center > .px-4').click()
        cy.visit('/my-stations')
        cy.get(':nth-child(2) > .my-4').contains('Legnica Piekary'&&'odwiedzona (1)')
        cy.get(':nth-child(3) > .my-4').contains('Legnica'&&'przejechana (1)')
        cy.get(':nth-child(4) > .my-4').contains('Tychy Żwaków'&&'odwiedzona (1)')
        cy.get(':nth-child(5) > .my-4').contains('Górki Pomorskie'&&'przejechana (1)')
    });
    it('add few time same station both as Odwiedzone and Przejechane', () => {
        Cypress._.times(5, (k) => {            
            cy.get(':nth-child(2) > .my-4 > .items-center > [title="Dodaj do przejechanych"] > .rounded').click()
            cy.get('.items-center > .px-4').click()
            cy.get(':nth-child(2) > .my-4 > .items-center > [title="Dodaj do odwiedzonych"] > .rounded').click()
            cy.get('.items-center > .px-4').click()
         })
        cy.visit('/my-stations')
        cy.get(':nth-child(2) > .my-4').contains('Górki Pomorskie'&&'przejechana (5)'&&'odwiedzona (5)')
    });
    it('My trips and My all stations in the same time input', () => {
        cy.get('.sidebar > .w-full > .rounded-lg').type('Legnica')
        cy.get(':nth-child(2) > .my-4 > .items-center > [title="Dodaj do odwiedzonych"] > .rounded').click()
        cy.get('.items-center > .px-4').click()
        cy.get(':nth-child(3) > .my-4 > .items-center > [title="Dodaj do przejechanych"] > .rounded').click()
        cy.get('.items-center > .px-4').click()
        cy.visit('/tour')
        cy.get(':nth-child(2) > .my-4 > .items-center > button > .rounded').click()
        cy.get(':nth-child(3) > .my-4 > .items-center > button > .rounded').click()
        cy.get('.bg-gradient-to-t > .w-full > .rounded-lg').type('Legnica')
        cy.get(':nth-child(2) > .my-4 > .items-center > button > .rounded').click()
        cy.get(':nth-child(3) > .my-4 > .items-center > button > .rounded').click()
        cy.get('.text-red-900').click().type('2023-01-18')
        
        cy.get('.break-words > p').click({ multiple: true })
        cy.visit('/my-stations')
        cy.get(':nth-child(2) > .my-4').contains('Tychy Żwaków'&&'przejechana (1)')
        cy.get(':nth-child(3) > .my-4').contains('Górki Pomorskie'&&'odwiedzona (1)')
        cy.get(':nth-child(4) > .my-4').contains('Legnica Piekary'&&'odwiedzona (1)'&&'przejechana (1)')
        cy.get(':nth-child(5) > .my-4').contains('Legnica'&&'odwiedzona (1)'&&'przejechana (1)')
    });
});