using Valadoc;

const string outdir = "docs";

public class Packagevisitor : Api.Visitor {
  Json.Object output = new Json.Object ();

  public override void visit_tree (Api.Tree tree) {
    assert_not_reached ();
  }

  public override void visit_package (Api.Package package) {
    assert_not_reached ();
  }
}

public class JsonDoclet : Doclet, Api.Visitor {
  public void process (Valadoc.Settings settings, Api.Tree tree, ErrorReporter errors) {
    info ("loaded doclet");
    DirUtils.create_with_parents (outdir, 0755);
    tree.accept (this);
  }

  public override void visit_tree (Api.Tree tree) {
    tree.accept_children (this);
  }

  public override void visit_package (Api.Package package) {
    package.accept_all_children (this);
  }
}

public Type register_plugin (ModuleLoader loader) {
  return typeof (JsonDoclet);
}
