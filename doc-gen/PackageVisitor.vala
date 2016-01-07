public class DocGen.Packagevisitor : Valadoc.Api.Visitor {
    Json.Object output = new Json.Object ();

    public override void visit_tree (Valadoc.Api.Tree tree) {
        assert_not_reached ();
    }

    public override void visit_package (Valadoc.Api.Package package) {
        assert_not_reached ();
    }
}