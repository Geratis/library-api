describe("Usuwanie autora", () => {
  it("Usuwanie autora z listy", () => {
    cy.visit("http://localhost/biblioteka/author/addAuthor");

    cy.get("form").should("exist");

    cy.get('input[name="first_name"]').type("Jan");
    cy.get('input[name="last_name"]').type("Nowak");
    cy.get("form").submit();

    cy.visit("http://localhost/biblioteka/author");
    cy.contains("Jan Nowak").should("exist");

    cy.contains("Jan Nowak")
      .parent()
      .within(() => {
        cy.contains("Usuń").click();
      });

    cy.contains("Jan Nowak").should("not.exist");
  });
});
