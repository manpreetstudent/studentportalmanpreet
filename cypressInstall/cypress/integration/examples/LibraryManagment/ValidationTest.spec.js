describe('This is my first Cypress test', () => {
    Cypress.Cookies.debug(true)

    it('Openining Student Portal', () => {
        cy.visit('http://localhost/LibraryManagement/index.php')
        
    });

    it('Check Element should be Visble', () => {
        cy.get('.active > .nav-link > .menu-title').should('exist')
        cy.get(':nth-child(2) > .nav-link > .menu-title').should('exist')

    });
    
    it('Checking Validation ', () => {
        cy.get('.active > .nav-link > .menu-title').should('exist')
        cy.get(':nth-child(2) > .nav-link > .menu-title').should('exist')
        cy.get(':nth-child(2) > .nav-link > .menu-title').click()
        cy.get('.mr-2').click()
        cy.get('#parsley-id-5 > .parsley-required').should('contain','required')
    });
})