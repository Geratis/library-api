describe("Strona główna", () => {
  it("ładuje się poprawnie i zawiera nagłówek", () => {
    cy.visit("http://localhost/biblioteka");
    cy.contains("Lista książek");
  });
});
