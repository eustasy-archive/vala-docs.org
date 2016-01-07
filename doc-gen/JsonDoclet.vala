namespace DocGen {
    private const string OUTPUT_DIR = "docs";

    public class JsonDoclet : Valadoc.Doclet, Valadoc.Api.Visitor {
        public void process (Valadoc.Settings settings, Valadoc.Api.Tree tree, Valadoc.ErrorReporter errors) {
            info ("Json doclet loaded.");

            DirUtils.create_with_parents (OUTPUT_DIR, 0755);

            tree.accept (this);
        }

        public override void visit_tree (Valadoc.Api.Tree tree) {
            tree.accept_children (this);
        }

        public override void visit_package (Valadoc.Api.Package package) {
            package.accept_all_children (this);
        }
    }
}

public Type register_plugin (Valadoc.ModuleLoader loader) {
    return typeof (DocGen.JsonDoclet);
}