describe("Usuwanie książki", () => {
  it("Usuwanie książki z listy", () => {
    cy.visit("http://localhost/biblioteka/book/addBook");

    cy.get("form").should("exist");

    cy.get('input[name="title"]').type("Książka do usunięcia");
    cy.get('input[name="genre"]').type("Thriller");
    cy.get('input[name="published_year"]').type("2023");
    cy.get("form").submit();

    cy.visit("http://localhost/biblioteka/book");
    cy.contains("Książka do usunięcia").should("exist");

    cy.contains("Książka do usunięcia")
      .parent()
      .within(() => {
        cy.contains("Usuń").click();
      });

    cy.contains("Książka do usunięcia").should("not.exist");
  });
});
