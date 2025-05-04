describe("Formularz edycji autora", () => {
  it("Ładuje formularz, edytuje pola autora i przesyła zmiany", () => {
    const bookId = 43;

    cy.visit(`http://localhost/biblioteka/author/updateAuthor/${bookId}`);

    cy.get('input[name="first_name"]').should("exist");
    cy.get('input[name="last_name"]').should("exist");

    cy.get('input[name="first_name"]')
      .clear()
      .type("Zaktualizowane imię autora");
    cy.get('input[name="last_name"]')
      .clear()
      .type("Zaktualizowane nazwisko autora");

    cy.get("form").submit();
  });
});
